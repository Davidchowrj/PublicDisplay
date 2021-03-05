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

$title = 'Content Management';
include 'components/adminheader.php';
include 'components/adminfooter.php';
include 'includes/DbConnect.php';
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
                    <span class="text-uppercase page-title mb-4">Content Management</span>
                    <div class="section">
                        <div class="row">
                            <div class="col-lg-auto col-md-auto col-sm-auto">
                                <button onclick="window.location.href = 'content_management.php?status=0';">New request</button>
                                <button onclick="window.location.href = 'content_management.php?status=1';">Approved request</button>
                                <button onclick="window.location.href = 'content_management.php?status=2';">Rejected request</button>
                                <button onclick="window.location.href = 'content_management.php?request';">All request</button>
                                <button onclick="window.location.href = 'content_management.php?active';">All Active post</button>
                                <button onclick="window.location.href = 'add_content.php';">Manually Add Content</button>
                            </div>
                        </div>
                        <div class="container">
                            <?php
                            if (isset($_GET['status'])) {
                                $statusCode = $_GET['status'];
                                $query = mysqli_query($con, "SELECT * FROM content WHERE `content_status` = '$statusCode'");

                                echo '<table class="table mb-0">
                                <tr>
                                    <th scope="col" class="border-0">Title</th>
                                    <th scope="col" class="border-0">Description</th>
                                    <th scope="col" class="border-0">Poster</th>
                                    <th scope="col" class="border-0">Venue</th>
                                    <th scope="col" class="border-0">Event Type</th>
                                    <th scope="col" class="border-0">Event Date</th>
                                    <th scope="col" class="border-0">Display date (from)</th>
                                    <th scope="col" class="border-0">Display date (to)</th>
                                    <th scope="col" class="border-0">Status</th>
                                </tr>';

                                while ($rows = mysqli_fetch_assoc($query)) {
                                    echo '<tr>';
                                    echo '<td>' . $rows['content_title'] . '</td>';
                                    echo '<td>' . $rows['content_desc'] . '</td>';
                                    echo '<td> <img height="200" width="180" src=' . $rows['content_link'] . '></td>';
                                    echo '<td>' . $rows['venue'] . '</td>';
                                    echo '<td>' . $rows['content_type'] . '</td>';
                                    echo '<td>' . $rows['content_date_time'] . '</td>';
                                    echo '<td>' . $rows['display_date_from'] . '</td>';
                                    echo '<td>' . $rows['display_date_to'] . '</td>';
                                    if($rows['content_status'] == 0){
                                        $status = "Pending Approval";
                                    }else if($rows['content_status'] == 1){
                                        $status = "Post approved";
                                    }else if($rows['content_status'] == 2){
                                        $status = "Post rejected";
                                    }else if($rows['content_status'] == 3){
                                        $status = "Pending contributor edit";
                                    }else if($rows['content_status'] == 4){
                                        $status = "Post expired";
                                    }else if($rows['content_status'] == 5){
                                        $status = "Post archive by content contributor";
                                    }else if($rows['content_status'] == 6){
                                        $status = "Post deleted";
                                    }
                                    echo '<td>' . $status . '</td>';
                                    echo '<td><a href=detailPage.php?contentId='.$rows["content_id"].'>See Details</a></td>';
                                }
                                echo '</table>';
                            }elseif (isset($_GET['request'])){
                                $query = mysqli_query($con, "SELECT * FROM content");
                                echo '<table class="table mb-0">
                                <tr>
                                    <th scope="col" class="border-0">Title</th>
                                    <th scope="col" class="border-0">Description</th>
                                    <th scope="col" class="border-0">Poster</th>
                                    <th scope="col" class="border-0">Venue</th>
                                    <th scope="col" class="border-0">Event Type</th>
                                    <th scope="col" class="border-0">Event Date</th>
                                    <th scope="col" class="border-0">Display date (from)</th>
                                    <th scope="col" class="border-0">Display date (to)</th>
                                    <th scope="col" class="border-0">Status</th>
                                </tr>';

                                while ($rows = mysqli_fetch_assoc($query)) {
                                    echo '<tr>';
                                    echo '<td>' . $rows['content_title'] . '</td>';
                                    echo '<td>' . $rows['content_desc'] . '</td>';
                                    echo '<td> <img height="200" width="180" src=' . $rows['content_link'] . '></td>';
                                    echo '<td>' . $rows['venue'] . '</td>';
                                    echo '<td>' . $rows['content_type'] . '</td>';
                                    echo '<td>' . $rows['content_date_time'] . '</td>';
                                    echo '<td>' . $rows['display_date_from'] . '</td>';
                                    echo '<td>' . $rows['display_date_to'] . '</td>';
                                    if($rows['content_status'] == 0){
                                        $status = "Pending Approval";
                                    }else if($rows['content_status'] == 1){
                                        $status = "Post approved";
                                    }else if($rows['content_status'] == 2){
                                        $status = "Post rejected";
                                    }else if($rows['content_status'] == 3){
                                        $status = "Pending contributor edit";
                                    }else if($rows['content_status'] == 4){
                                        $status = "Post expired";
                                    }else if($rows['content_status'] == 5){
                                        $status = "Post archive by content contributor";
                                    }else if($rows['content_status'] == 6){
                                        $status = "Post deleted";
                                    }
                                    echo '<td>' . $status . '</td>';
                                }
                                echo '</table>';
                            }elseif (isset($_GET['active'])) {
                                $query = mysqli_query($con, "SELECT * FROM content WHERE `content_status` = 1 AND current_timestamp >`display_date_from` AND current_timestamp < `display_date_to`");
                                echo '<table class="table mb-0">
                                <tr>
                                    <th scope="col" class="border-0">Title</th>
                                    <th scope="col" class="border-0">Description</th>
                                    <th scope="col" class="border-0">Poster</th>
                                    <th scope="col" class="border-0">Venue</th>
                                    <th scope="col" class="border-0">Event Type</th>
                                    <th scope="col" class="border-0">Event Date</th>
                                    <th scope="col" class="border-0">Display date (from)</th>
                                    <th scope="col" class="border-0">Display date (to)</th>
                                </tr>';

                                while ($rows = mysqli_fetch_assoc($query)) {
                                    echo '<tr>';
                                    echo '<td>' . $rows['content_title'] . '</td>';
                                    echo '<td>' . $rows['content_desc'] . '</td>';
                                    echo '<td> <img height="200" width="180" src=' . $rows['content_link'] . '></td>';
                                    echo '<td>' . $rows['venue'] . '</td>';
                                    echo '<td>' . $rows['content_type'] . '</td>';
                                    echo '<td>' . $rows['content_date_time'] . '</td>';
                                    echo '<td>' . $rows['display_date_from'] . '</td>';
                                    echo '<td>' . $rows['display_date_to'] . '</td>';
                                }
                                echo '</table>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>