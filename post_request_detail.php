<?php


if (!isset($_COOKIE['user_id'])) {
    // Need the functions:
    require('login_functions.inc.php');
    redirect_user('login.php');
} elseif ($_COOKIE['role_id'] != 2) {
    require('login_functions.inc.php');
    redirect_user('login.php');
    echo "You need an contributor account to access";
}

$title = 'Post Request Details';
include 'components/adminheader.php';
include 'components/adminfooter.php';
include "includes/DbConnect.php";
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
                                    $contentId = $_GET['reqId'];
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
                                            echo '<a href=post_request_detail.php?archive=' . $rows["content_id"] . '>Archive Post</a>';
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
                                            echo "<h5>Request Rejected Reason</h5>";
                                            echo '<p>' . $rows['reject_reason'] . '</p>';
                                            echo '<button onclick="history.back()">Back</button>';
                                        } elseif ($rows['content_status'] == 5) {
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
                                            echo '<a href=post_request_detail.php?active=' . $rows["content_id"] . '>Active Post</a>';
                                        }
                                    }
                                }
                                ?>
                                <?php
                                    if(isset($_GET['archive'])){
                                        $content_id = $_GET['archive'];
                                        $status_code = 5;
                                        $archiveQuery = "UPDATE `content` SET `content_status` = '$status_code' WHERE `content_id` = '$content_id'";
                                        if(mysqli_query($con,$archiveQuery)){
                                            echo "Archive post done";
                                            echo '<button onclick="history.back()">Back</button>';
                                        }else{
                                            echo mysqli_error($con);
                                        }
                                    }elseif(isset($_GET['active'])){
                                        $content_id = $_GET['active'];
                                        $status_code = 1;
                                        $archiveQuery = "UPDATE `content` SET `content_status` = '$status_code' WHERE `content_id` = '$content_id'";
                                        if(mysqli_query($con,$archiveQuery)){
                                            echo "Active post done";
                                            echo '<button onclick="history.back()">Back</button>';
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
</main>
