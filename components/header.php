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
    <link href="./css/shards.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/shards-extras.min.css">
    <link rel="stylesheet" href="./css/shards-dashboards.1.1.0.min">
    <!-- Global CSS-->
    <link rel="stylesheet" href="./css/global.css">
    <!-- Material Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">

</head>

<body>
<!-- Header-->
<div class="d-flex justify-content-center flex-column">
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light pt-4 px-0">
            <a class="navbar-brand" href="index.php">
                <img src="./images/darkLogo.png" class="mr-2" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#NavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="NavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($page == 'index') {
                        echo 'active';
                    } ?>">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?php if ($page == 'events') {
                        echo 'active';
                    } ?>">
                        <a class="nav-link" href="events.php">Events</a>
                    </li>
                    <li class="nav-item <?php if ($page == 'request') {
                        echo 'active';
                    } ?>">
                    <a class="nav-link" href="request.php">Request</a>
                    </li>
                    <li class="nav-item <?php if ($page == 'submission') {
                        echo 'active';
                    } ?>">
                            <a class="nav-link" href="submission.php">Submit Content</a>
                        </li>
                    <li class="nav-item <?php if ($page == 'login') {
                        echo 'active';
                    } ?>">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!--/Header-->