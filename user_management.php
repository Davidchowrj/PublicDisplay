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

$title = 'User Management';
include 'components/adminheader.php';
include 'components/adminfooter.php';
include 'includes/DbConnect.php';

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
                <a class="nav-link dropdown-toggle text-nowrap mr-5 " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle mr-2" src="http://via.placeholder.com/50x50 " alt="User Avatar">
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
                    <span class="text-uppercase page-title mb-4">User Management</span>
                    <div class="section">
                        <div class="row">
                            <div class="col-lg-auto col-md-auto col-sm-auto">
                                <button onclick="window.location.href = 'user_management.php?status=0';">New request</button>
                                <button onclick="window.location.href = 'user_management.php?status=1';">Approved request</button>
                                <button onclick="window.location.href = 'user_management.php?status=2';">Reject request</button>
                                <button onclick="window.location.href = 'user_management.php?request';">All Request</button>
                                <button onclick="window.location.href = 'user_management.php?member';">All user</button>
                                <button onclick="window.location.href = 'add_user.php';">Manually Add New User</button>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <?php
                                if (isset($_GET['status'])) {
                                    $statusCode = $_GET['status'];
                                    $query = mysqli_query($con, "SELECT * FROM user_request WHERE `req_status` = '$statusCode'");

                                    echo '<table class="table mb-0">
                                <tr>
                                    <th scope="col" class="border-0">Name</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Organization</th>
                                    <th scope="col" class="border-0">Request Reason</th>
                                    <th scope="col" class="border-0">Requested at</th>
                                    <th scope="col" class="border-0">Status</th>
                                </tr>';

                                    while ($rows = mysqli_fetch_assoc($query)) {
                                        echo '<tr>';
                                        echo '<td>' . $rows['req_fullName'] . '</td>';
                                        echo '<td>' . $rows['req_email'] . '</td>';
                                        echo '<td>' . $rows['req_organization'] . '</td>';
                                        echo '<td>' . $rows['req_reason'] . '</td>';
                                        echo '<td>' . $rows['requested_at'] . '</td>';

                                        if($rows['req_status'] == 0){
                                            $status = "Pending Approval";
                                        }else if($rows['req_status'] == 1){
                                            $status = "Request approved";
                                        }else if($rows['req_status'] == 2) {
                                            $status = "Request rejected";
                                        }else if($rows['req_status'] == 5) {
                                            $status = "Request archive. User deleted.";
                                        }
                                        echo '<td>' . $status . '</td>';
                                        echo '<td><a href=memberDetailPage.php?reqId='.$rows["request_id"].'>See Details</a></td>';
                                    }
                                    echo '</table>';
                                }else if (isset($_GET['member'])) {
                                    $query = mysqli_query($con, "SELECT users.*, user_role.role_id FROM users INNER JOIN user_role ON users.user_id = user_role.user_id");

                                    echo '<table class="table mb-0">
                                <tr>
                                    <th scope="col" class="border-0">Name</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Organization</th>
                                    <th scope="col" class="border-0">Role</th>
                                </tr>';

                                    while ($rows = mysqli_fetch_assoc($query)) {
                                        echo '<tr>';
                                        echo '<td>' . $rows['user_name'] . '</td>';
                                        echo '<td>' . $rows['user_email'] . '</td>';
                                        echo '<td>' . $rows['user_org'] . '</td>';
                                        if ($rows['role_id'] == 1) {
                                            $role = "Admin";
                                        } else if ($rows['role_id'] == 2) {
                                            $role = "Content contributor";
                                        }
                                        echo '<td>' . $role . '</td>';
                                        echo '<td><a href=user_management.php?delete=' . $rows["user_id"] . '&amp;email=' . $rows["user_email"] .'>Delete User</a></td>';
                                    }
                                    echo '</table>';
                                }elseif(isset($_GET['request'])){
                                    $statusCode = $_GET['status'];
                                    $query = mysqli_query($con, "SELECT * FROM user_request");

                                    echo '<table class="table mb-0">
                                <tr>
                                    <th scope="col" class="border-0">Name</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Organization</th>
                                    <th scope="col" class="border-0">Request Reason</th>
                                    <th scope="col" class="border-0">Requested at</th>
                                    <th scope="col" class="border-0">Status</th>
                                </tr>';

                                    while ($rows = mysqli_fetch_assoc($query)) {
                                        echo '<tr>';
                                        echo '<td>' . $rows['req_fullName'] . '</td>';
                                        echo '<td>' . $rows['req_email'] . '</td>';
                                        echo '<td>' . $rows['req_organization'] . '</td>';
                                        echo '<td>' . $rows['req_reason'] . '</td>';
                                        echo '<td>' . $rows['requested_at'] . '</td>';

                                        if($rows['req_status'] == 0){
                                            $status = "Pending Approval";
                                        }else if($rows['req_status'] == 1){
                                            $status = "Request approved";
                                        }else if($rows['req_status'] == 2) {
                                            $status = "Request rejected";
                                        }else if($rows['req_status'] == 5) {
                                            $status = "Request archive. User deleted.";
                                        }
                                        echo '<td>' . $status . '</td>';
                                        echo '<td><a href=memberDetailPage.php?reqId='.$rows["request_id"].'>See Details</a></td>';
                                    }
                                    echo '</table>';
                                }
                                ?>
                                <?php
                                if(isset($_GET['delete'])){
                                    $id = $_GET['delete'];
                                    $email = $_GET['email'];
                                    $statusCode = 5;
                                    $deleteUserQuery= mysqli_query($con,"DELETE FROM `users` WHERE `user_id` = '$id'");
                                    $deleteUserRoleQuery= mysqli_query($con,"DELETE FROM `user_role` WHERE `user_id` = '$id'");
                                    $deleteUserRequestQuery= mysqli_query($con,"UPDATE `user_request` SET `req_status` = '$statusCode' WHERE `req_email` = '$email'");
                                    if($deleteUserRequestQuery){
                                        if($deleteUserQuery){
                                            if ($deleteUserRoleQuery){
                                                $output = '<p>Dear User,</p>';
                                                $output .= '<p>We had reviewed your account.</p>';
                                                $output .= '<p>We would like to inform you that your account request has been removed. We found the account perform illegal action.</p>';
                                                $output .= '<p>Thanks,</p>';
                                                $output .= '<p>CMS Team</p>';
                                                $body = $output;
                                                $subject = "Account Removed - pd.oscsa.my";
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
                                                    echo "User removed. Email sent";
                                                }
                                            }else{
                                                echo mysqli_error($con);
                                            }
                                        }else{
                                            echo mysqli_error($con);
                                        }
                                    }else{
                                        echo mysqli_error($con);
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>