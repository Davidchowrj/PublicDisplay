<?php

if (!isset($_COOKIE['user_id'])) {
    // Need the functions:
    require('login_functions.inc.php');
    redirect_user('login.php');
} elseif ($_COOKIE['role_id'] != 1) {
    require('login_functions.inc.php');
    redirect_user('login.php');
    echo "You need an admin account to access";
}

$title = 'Detail';
include 'components/adminheader.php';
include 'components/adminfooter.php';
include "includes/DbConnect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/SMTP.php';
require 'vendor/PHPMailer.php';
require 'vendor/Exception.php';

require_once 'includes/functions.php';
?>

<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
    <div class="main-navbar sticky-top bg-white">
        <!-- Main Navbar -->
        <nav class="navbar align-items-center navbar-light flex-md-nowrap p-0 ml-auto" aria-label="breadcrumb">
            <!-- User Section-->
            <li class="nav-item dropdown mr-auto flex-fill">
                <a class="nav-link dropdown-toggle text-nowrap mr-5 " data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle mr-2" src="http://via.placeholder.com/50x50 "
                         alt="User Avatar">
                    <span class="d-none d-md-inline-block">
                        <?php
                        echo 'Welcome, ' . $_COOKIE['name'];
                        ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item text-danger" href="logout.php">
                        <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                </div>
            </li>
        </nav>
    </div>

    <!-- Content-->
    <div class="main-content-container container-fluid px-4">
        <div class="main-content-container container-fluid px-4 ">
            <div class="page-header row no-gutters py-4 ">
                <div class="col-lg-12 col-sm-4 text-center text-sm-left">
                    <span class="text-uppercase page-title mb-4">Details</span>
                    <div class="section">
                        <div class="row">
                            <div class="container">
                                <?php
                                include 'includes/DbConnect.php';
                                if (isset($_GET['reqId'])) {
                                    $reqId = $_GET['reqId'];
                                    $query = mysqli_query($con, "SELECT * FROM `user_request` WHERE request_id = '$reqId'");
                                    while ($rows = mysqli_fetch_assoc($query)) {
                                        if ($rows['req_status'] == 0) {
                                            echo "<h5>Name</h5>";
                                            echo '<p>' . $rows['req_fullName'] . '</p>';
                                            echo "<h5>Email</h5>";
                                            echo '<p>' . $rows['req_email'] . '</p>';
                                            echo "<h5>Organization</h5>";
                                            echo '<p>' . $rows['req_organization'] . '</p>';
                                            echo "<h5>Reason</h5>";
                                            echo '<p>' . $rows['req_reason'] . '</p>';
                                            echo "<h5>Requested at</h5>";
                                            echo '<p>' . $rows['requested_at'] . '</p>';
                                            ?>
                                            <div class="section">
                                                <div class="row">
                                                    <div class="col-lg-auto col-md-auto col-sm-auto">
                                                        <button onclick="history.back()">Back</button>
                                                        <?php
                                                        echo '<a href=memberDetailPage.php?approve=' . $rows["request_id"] . '&amp;email=' . $rows["req_email"] . '>Approve Request   </a>';
                                                        echo '<a href=memberDetailPage.php?reject=' . $rows["request_id"] . '&amp;email=' . $rows["req_email"] . '>Reject Request</a>';
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } elseif ($rows['req_status'] == 1) {
                                            echo "<h5>Name</h5>";
                                            echo '<p>' . $rows['req_fullName'] . '</p>';
                                            echo "<h5>Email</h5>";
                                            echo '<p>' . $rows['req_email'] . '</p>';
                                            echo "<h5>Organization</h5>";
                                            echo '<p>' . $rows['req_organization'] . '</p>';
                                            echo "<h5>Reason</h5>";
                                            echo '<p>' . $rows['req_reason'] . '</p>';
                                            echo "<h5>Requested at</h5>";
                                            echo '<p>' . $rows['requested_at'] . '</p>';
                                            echo '<button onclick="history.back()">Back</button>';
                                        } elseif ($rows['req_status'] == 2) {
                                            echo "<h5>Name</h5>";
                                            echo '<p>' . $rows['req_fullName'] . '</p>';
                                            echo "<h5>Email</h5>";
                                            echo '<p>' . $rows['req_email'] . '</p>';
                                            echo "<h5>Organization</h5>";
                                            echo '<p>' . $rows['req_organization'] . '</p>';
                                            echo "<h5>Reason</h5>";
                                            echo '<p>' . $rows['req_reason'] . '</p>';
                                            echo "<h5>Requested at</h5>";
                                            echo '<p>' . $rows['requested_at'] . '</p>';
                                            echo "<h5>Request Rejected Reason</h5>";
                                            echo '<p>' . $rows['reject_reason'] . '</p>';
                                            echo '<button onclick="history.back()">Back</button>';
                                        }elseif ($rows['req_status'] == 5) {
                                            echo "<h5>Name</h5>";
                                            echo '<p>' . $rows['req_fullName'] . '</p>';
                                            echo "<h5>Email</h5>";
                                            echo '<p>' . $rows['req_email'] . '</p>';
                                            echo "<h5>Organization</h5>";
                                            echo '<p>' . $rows['req_organization'] . '</p>';
                                            echo "<h5>Reason</h5>";
                                            echo '<p>' . $rows['req_reason'] . '</p>';
                                            echo "<h5>Requested at</h5>";
                                            echo '<p>' . $rows['requested_at'] . '</p>';
                                            echo "<h5>Request Archive. User Account Deleted.</h5>";
                                            echo '<button onclick="history.back()">Back</button>';
                                        }
                                    }
                                }
                                ?>
                                <?php
                                if (isset($_GET['approve'])) {
                                    $id = $_GET['approve'];
                                    $statusCode = 1;
                                    $email = $_GET['email'];
                                    $adminId = $_COOKIE['user_id'];
                                    $query = "UPDATE `user_request` SET `req_status` = '$statusCode', `handle_by` = '$adminId' WHERE `request_id` = '$id'";
                                    if (!userExists($email)) {
                                        if (mysqli_query($con, $query)) {
                                            $detailQuery = mysqli_query($con, "SELECT * FROM user_request WHERE request_id = '$id'");
                                            while ($rows = mysqli_fetch_assoc($detailQuery)) {
                                                $name = $rows['req_fullName'];
                                                $email = $rows['req_email'];
                                                $org = $rows['req_organization'];
                                                if (!userExists($email)) {
                                                    $rPass = randomPassword();
                                                    //Get a unique Salt
                                                    $salt = getSalt();
                                                    //Generate a unique password Hash
                                                    $passwordHash = password_hash(concatPasswordWithSalt($rPass, $salt), PASSWORD_DEFAULT);

                                                    $date = date('Y-m-d H:i:s');

                                                    $addQuery = "INSERT INTO `users`(`user_name`, `user_email`, `user_pass_hash`,`user_pass_salt`,`user_org`,`user_created_at`) VALUES ('$name','$email','$passwordHash','$salt', '$org','$date')";
                                                    $user_idQuery = "SELECT `user_id` FROM `users` WHERE `user_email` = '$email'";

                                                    if (mysqli_query($con, $addQuery)) {
                                                        //echo "<p>User successful created</p>";
                                                        $user_id_result = mysqli_query($con, $user_idQuery);
                                                        if (mysqli_num_rows($user_id_result) == 1) {
                                                            $row = mysqli_fetch_array($user_id_result, MYSQLI_ASSOC);
                                                            $user_id = $row["user_id"];
                                                            if (!empty($user_id)) {
                                                                $role_id = 2;
                                                                $roleQuery = "INSERT INTO `user_role`(`user_id`,`role_id`) values ('$user_id','$role_id')";
                                                                if (mysqli_query($con, $roleQuery)) {
                                                                    $output = '<p>Dear User,</p>';
                                                                    $output .= '<p>We had reviewed your content contributor account request</p>';
                                                                    $output .= '<p>We would like to inform you that your post request has been approved.Your login info as below.</p>';
                                                                    $output .= '<p>Email:' . $email . '</p>';
                                                                    $output .= '<p>Password:' . $rPass . '</p>';
                                                                    $output .= '<p>Thanks,</p>';
                                                                    $output .= '<p>CMS Team</p>';
                                                                    $body = $output;
                                                                    $subject = "Post Approved - pd.oscsa.my";
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
                                                                    if (!$mail->Send()) {
                                                                        echo $mail->ErrorInfo;
                                                                    } else {
                                                                        echo "Request approved. Email sent";
                                                                    }
                                                                } else {
                                                                    echo mysqli_error($con);
                                                                }
                                                            } else {
                                                                echo mysqli_error($con);
                                                            }
                                                        } else {
                                                            echo mysqli_error($con);
                                                        }
                                                    } else {
                                                        echo "<p>User Exists</p>";
                                                    }
                                                }
                                            }
                                        }else {
                                            echo mysqli_error($con);
                                        }
                                    } else{
                                        echo "<p>User Exists</p>";
                                    }
                                } elseif (isset($_GET['reject'])) {
                                    $id = $_GET['reject'];
                                    $statusCode = 2;
                                    $email = $_GET['email'];
                                    $adminId = $_COOKIE['user_id'];
                                    ?>
                                    <form method="post">
                                        <div class="my-3">
                                            <label for="reason">Reject reason</label>
                                            <input type="text" class="form-control" name="reason" id="reason"
                                                   placeholder="" required>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            </input>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                    <button class="btn btn-info btn-lg btn-block mb-5" type="submit"
                                                            id="reject" name="rejectReason">Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['rejectReason'])) {
                                        $reason = $_POST['reason'];
                                        $query = "UPDATE `user_request` SET `req_status` = '$statusCode', `handle_by` = '$adminId', `reject_reason` = '$reason' WHERE `request_id` = '$id'";
                                        if (mysqli_query($con, $query)) {
                                            $output = '<p>Dear User,</p>';
                                            $output .= '<p>We had reviewed your content contributor account request</p>';
                                            $output .= '<p>We would like to inform you that your account request has been rejected. Reject reason as below.</p>';
                                            $output .= '<p>Reason: '.$reason.'</p>';
                                            $output .= '<p>Thanks,</p>';
                                            $output .= '<p>CMS Team</p>';
                                            $body = $output;
                                            $subject = "Post Approved - pd.oscsa.my";
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
                                            if (!$mail->Send()) {
                                                echo $mail->ErrorInfo;
                                            } else {
                                                echo "Request rejected. Email sent";
                                            }
                                        } else {
                                            echo mysqli_error($con);
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>

