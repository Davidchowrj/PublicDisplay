<!DOCTYPE html>
<html lang="en">
<head>
    <title>

        <?php

        if (isset($title) && !empty($title)) {
            echo $title;
        } else {
            echo "CMS";
        }


        ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- UI Component CSS-->
    <link href="./css/shards-dashboards.1.1.0.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/extras.1.1.0.min.css">
    <link rel="stylesheet" href="./css/shards-dashboards.1.1.0.min">
    <!-- Global CSS-->
    <link rel="stylesheet" href="./css/global.css">
    <!-- Material Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">


</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-dark bg-dark flex-md-nowrap border-bottom p-0">
                    <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <img id="main-logo" class="d-inline-block align-center" style="max-width: 320px"
                                 src="../images/big logo.png" alt="Admin Panel">
                        </div>
                    </a>
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons">&#xE5C4;</i>
                    </a>
                </nav>
            </div>
            <div class="nav-wrapper">
                <ul class="nav flex-column">
                    <?php
                    //Admin
                    if ($_COOKIE['role_id'] == 1) {
                    ?>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="/adminIndex.php">
                                <i class="material-icons">table_chart</i>
                                <span>All Post Request
                                </span>
                            </a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="/content_management.php?status=0">
                                <i class="material-icons">edit</i>
                                <span>Content Management
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin_post.php?active">
                                <i class="material-icons">table_chart</i>
                                <span>My Post
                                </span>
                            </a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="material-icons">table_chart</i>
                                <span>All New User Request
                                </span>
                            </a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="/user_management.php?status=0">
                                <i class="material-icons">edit</i>
                                <span>User Management
                                </span>
                            </a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link " href="#">
                                <i class="material-icons">person</i>
                                <span>User Profile</span>
                            </a>
                        </li>-->
                    <?php } ?>

                    <?php
                    //Content contributor
                    if ($_COOKIE['role_id'] != 1) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/post_request.php?status=0">
                                <i class="material-icons">table_chart</i>
                                <span>My Post Request
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/submission.php">
                                <i class="material-icons">note_add</i>
                                <span>New Post Request</span>
                            </a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link " href="#">
                                <i class="material-icons">person</i>
                                <span>User Profile</span>
                            </a>
                        </li>-->
                    <?php } ?>

                    <!--<li class="nav-item">
                        <a class="nav-link " href="add-new-post.html">
                            <i class="material-icons">note_add</i>
                            <i class="material-icons">edit</i>
                            <i class="material-icons">vertical_split</i>
                            <span>Blog Posts</span>
                            <span>Add New Post</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="form-components.html">
                            <i class="material-icons">view_module</i>
                            <span>Forms &amp; Components</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="tables.html">
                            <i class="material-icons">table_chart</i>
                            <span>Tables</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="errors.html">
                            <i class="material-icons">error</i>
                            <span>Errors</span>
                        </a>
                    </li>-->
                </ul>
            </div>
        </aside>
        <!-- End Main Sidebar -->