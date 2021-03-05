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
                                if (isset($_GET['contentId'])) {
                                    $contentId = $_GET['contentId'];
                                    $query = mysqli_query($con, "SELECT content.*, users.user_name, users.user_email FROM `content` INNER JOIN `users` ON content.created_by = users.user_id WHERE content.content_id = '$contentId'");
                                    while ($rows = mysqli_fetch_assoc($query)) {
                                        if ($rows['content_status'] == 0) {
                                            echo "<h5>Title</h5>";
                                            echo '<p>' . $rows['content_title'] . '</p>';
                                            echo "<h5>Description</h5>";
                                            echo '<p>' . $rows['content_desc'] . '</p>';
                                            echo "<h5>Poster</h5>";
                                            ?>
                                            <img src="<?= $rows['content_link'] ?>"
                                                 alt="<?= $rows['content_title'] ?>">
                                            <?php
                                            echo "<h5>Venue</h5>";
                                            echo '<p>' . $rows['venue'] . '</p>';
                                            echo "<h5>Type</h5>";
                                            echo '<p>' . $rows['content_type'] . '</p>';
                                            echo "<h5>Event Date Time</h5>";
                                            echo '<p>' . $rows['content_date_time'] . '</p>';
                                            echo "<h5>Display Date (from)</h5>";
                                            echo '<p>' . $rows['display_date_from'] . '</p>';
                                            echo "<h5>Display Date (to)</h5>";
                                            echo '<p>' . $rows['display_date_to'] . '</p>';
                                            echo "<h5>Creator Name</h5>";
                                            echo '<p>' . $rows['user_name'] . '</p>';
                                            echo "<h5>Creator Email</h5>";
                                            echo '<p>' . $rows['user_email'] . '</p>';
                                            ?>
                                            <div class="section">
                                                <div class="row">
                                                    <div class="col-lg-auto col-md-auto col-sm-auto">
                                                        <button onclick="history.back()">Back</button>
                                                        <?php
                                                        echo '<a href=detailPage.php?approve=' . $rows["content_id"] . '&amp;email=' . $rows["user_email"] . '>Approve Request   </a>';
                                                        echo '<a href=detailPage.php?reject=' . $rows["content_id"] . '&amp;email=' . $rows["user_email"] . '>Reject Request</a>';
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } elseif ($rows['content_status'] == 1) {
                                            echo "<h5>Title</h5>";
                                            echo '<p>' . $rows['content_title'] . '</p>';
                                            echo "<h5>Description</h5>";
                                            echo '<p>' . $rows['content_desc'] . '</p>';
                                            echo "<h5>Poster</h5>";
                                            ?>
                                            <img src="<?= $rows['content_link'] ?>"
                                                 alt="<?= $rows['content_title'] ?>">
                                            <?php
                                            echo "<h5>Venue</h5>";
                                            echo '<p>' . $rows['venue'] . '</p>';
                                            echo "<h5>Type</h5>";
                                            echo '<p>' . $rows['content_type'] . '</p>';
                                            echo "<h5>Event Date Time</h5>";
                                            echo '<p>' . $rows['content_date_time'] . '</p>';
                                            echo "<h5>Display Date (from)</h5>";
                                            echo '<p>' . $rows['display_date_from'] . '</p>';
                                            echo "<h5>Display Date (to)</h5>";
                                            echo '<p>' . $rows['display_date_to'] . '</p>';
                                            echo "<h5>Creator Name</h5>";
                                            echo '<p>' . $rows['user_name'] . '</p>';
                                            echo "<h5>Creator Email</h5>";
                                            echo '<p>' . $rows['user_email'] . '</p>';
                                            echo '<button onclick="history.back()">Back</button>';
                                            echo '<a href=detailPage.php?delete=' . $rows["content_id"] . '&amp;email=' . $rows["user_email"] . '>Delete Post</a>';
                                        } elseif ($rows['content_status'] == 2) {
                                            echo "<h5>Title</h5>";
                                            echo '<p>' . $rows['content_title'] . '</p>';
                                            echo "<h5>Description</h5>";
                                            echo '<p>' . $rows['content_desc'] . '</p>';
                                            echo "<h5>Poster</h5>";
                                            ?>
                                            <img src="<?= $rows['content_link'] ?>"
                                                 alt="<?= $rows['content_title'] ?>">
                                            <?php
                                            echo "<h5>Venue</h5>";
                                            echo '<p>' . $rows['venue'] . '</p>';
                                            echo "<h5>Type</h5>";
                                            echo '<p>' . $rows['content_type'] . '</p>';
                                            echo "<h5>Event Date Time</h5>";
                                            echo '<p>' . $rows['content_date_time'] . '</p>';
                                            echo "<h5>Display Date (from)</h5>";
                                            echo '<p>' . $rows['display_date_from'] . '</p>';
                                            echo "<h5>Display Date (to)</h5>";
                                            echo '<p>' . $rows['display_date_to'] . '</p>';
                                            echo "<h5>Creator Name</h5>";
                                            echo '<p>' . $rows['user_name'] . '</p>';
                                            echo "<h5>Creator Email</h5>";
                                            echo '<p>' . $rows['user_email'] . '</p>';
                                            echo "<h5>Post Rejected Reason</h5>";
                                            echo '<p>' . $rows['reject_reason'] . '</p>';
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
                                    $query = "UPDATE `content` SET `content_status` = '$statusCode', `approved_by` = '$adminId' WHERE `content_id` = '$id'";
                                    if (mysqli_query($con, $query)) {
                                        $output = '<p>Dear User,</p>';
                                        $output .= '<p>We had reviewed your content post request</p>';
                                        $output .= '<p>We would like to inform you that your post request has been approved. Please go to your account and check the status.</p>';
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
                                        $query = "UPDATE `content` SET `content_status` = '$statusCode', `approved_by` = '$adminId', `reject_reason` = '$reason' WHERE `content_id` = '$id'";
                                        if (mysqli_query($con, $query)) {
                                            $output = '<p>Dear User,</p>';
                                            $output .= '<p>We had reviewed your content post request</p>';
                                            $output .= '<p>We would like to inform you that your post request has been rejected. Please go to your account and check the status and reject reason.</p>';
                                            $output .= '<p>Thanks,</p>';
                                            $output .= '<p>CMS Team</p>';
                                            $body = $output;
                                            $subject = "Post Rejected - pd.oscsa.my";
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
                                } elseif (isset($_GET['delete'])) {
                                    $id = $_GET['delete'];
                                    $statusCode = 6;
                                    $email = $_GET['email'];
                                    $adminId = $_COOKIE['user_id'];
                                    $query = "UPDATE `content` SET `content_status` = '$statusCode', `approved_by` = '$adminId' WHERE `content_id` = '$id'";
                                    if (mysqli_query($con, $query)) {
                                        $output = '<p>Dear User,</p>';
                                        $output .= '<p>We found your post is inappropriate.</p>';
                                        $output .= '<p>We would like to inform you that your post  has been deleted.</p>';
                                        $output .= '<p>Thanks,</p>';
                                        $output .= '<p>CMS Team</p>';
                                        $body = $output;
                                        $subject = "Post Deleted - pd.oscsa.my";
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
                                            echo "Post deleted. Email sent";
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

