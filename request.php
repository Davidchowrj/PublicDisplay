<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/SMTP.php';
require 'vendor/PHPMailer.php';
require 'vendor/Exception.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'includes/DbConnect.php';

    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $org = $_POST['organization'];
    $reason = $_POST['reason'];

    $date = date('Y-m-d H:i:s');

    $checkQuery = "SELECT `request_id` from `user_request` WHERE `req_email` = '$email'";
    $query = "INSERT INTO `user_request`(`req_fullName`, `req_email`, `req_organization`, `req_reason`, `req_status`, `requested_at`) VALUES ('$name', '$email', '$org', '$reason', 0,'$date')";

    $checkResult = mysqli_query($con, $checkQuery);
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($checkResult) == 0) {
        if ($result) {
            /**send email**/
            $output = '<p>Dear User,</p>';
            $output .= '<p>We had received your content contributor account request</p>';
            $output .= '<p>Please allow 2 working days for us to review your request. You will receive another email when your account is ready.</p>';
            $output .= '<p>Thanks,</p>';
            $output .= '<p>CMS Team</p>';
            $body = $output;
            $subject = "Content Contributor Account Request - pd.oscsa.my";
            $email_to = $email;
            $fromserver = "admin@pd.oscsa.my";
            $mail = new PHPMailer();
            //$mail->IsSMTP();
            $mail->Host = "pd.oscsa.my"; // Enter your host here
            $mail->SMTPAuth = true;
            $mail->Username = "admin@pd.oscsa.my"; // Enter your email here
            $mail->Password = "Codecamp@19"; //Enter your password here
            $mail->Port = 465;
            $mail->SMTPSecure = 'tls';
            $mail->IsHTML(true);
            $mail->From = "admin@pd.oscsa.my";
            $mail->FromName = "CMS Team";
            $mail->Sender = $fromserver; // indicates ReturnPath header
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email_to);
            if(!$mail->Send()){
                 echo $mail->ErrorInfo;
            }else{
                echo "<script type='text/javascript'>alert('Successful send request. Email sent.');</script>";
            }
        } else {
            echo mysqli_error($con);
        }
    }else{
        echo "<script type='text/javascript'>alert('This email has been send request before. Please allow some time for us to reply. Thank you.');</script>";
    }
}

// Create the page:
include ('request_page.inc.php');