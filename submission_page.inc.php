<?php

    
if (!isset($_COOKIE['user_id'])) {
    // Need the functions:
    require('login_functions.inc.php');
    redirect_user('login.php');
} elseif ($_COOKIE['role_id'] !=2) {
    require('login_functions.inc.php');
    redirect_user('login.php');
    echo "You need an contributor account to access";
}

$title = 'Submission';
include 'components/adminheader.php';
include 'components/adminfooter.php';
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
                    <span class="text-uppercase page-title mb-4">Add New Post Request</span>
                    <div class="section">
                        <div class="container">
                            <div class="row">
                                <form class="needs-validation" novalidate action="submission.php" method="post" enctype="multipart/form-data">
                                    <div class="my-3">
                                        <label for="EName">Content Title</label>
                                        <input type="text" class="form-control" name="ETitle" id="ETitle" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid title.
                                        </div>
                                    </div>

                                    <div class="my-3">
                                        <label for="EPurpose">Content Description</label>
                                        <input type="text" class="form-control" name="EDesc" id="EDesc" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please enter the content details
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-6"><label for="TemplateFile">Attach Template</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file" name="TemplateFile" id="TemplateFile" required">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="EType">Content Type</label>
                                            <select class="custom-select d-block w-100" name="EType" required>
                                                <option value="">-Select Event Type-</option>
                                                <option value="talks"> Talks</option>
                                                <option value="workshop"> Workshop</option>
                                                <option value="announcement"> Announcement</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select an Event Type.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="StartDate">Date of Event</label>
                                            <input type="date" class="form-control" name="EDate" id="EDate" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid date.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="Time">Time of Event</label>
                                            <input type="Time" class="form-control" name="ETime" id="ETime" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Please select a valid time (am/pm).
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="EndDate">Date Display (From)</label>
                                            <input type="date" class="form-control" name="StartDate" id="StartDate" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid date.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="EndDate">Date Display (To)</label>
                                            <input type="date" class="form-control" name="EndDate" id="EndDate" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid date.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Venue">Venue</label>
                                        <input type="Venue" class="form-control" name="Venue" id="Venue" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter a valid Venue.
                                        </div>
                                    </div>

                                    <hr class="my-auto">
                                    <div class="custom-control custom-checkbox my-4">
                                        <input type="checkbox" class="custom-control-input" id="TC" required>
                                        <label class="custom-control-label" for="TC">I agree to the terms and
                                            conditions of using
                                            this service</label>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        </input>
                                        <div class="row">
                                            <!--<div class="col-lg-6 col-md-12 sm-12">
                                                <button onclick="goBack()" class="btn btn-info btn-lg btn-block mb-5">Previous Page</button>
                                            </div>-->

                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <button class="btn btn-info btn-lg btn-block mb-5" type="submit" id="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section template">
                                        <div class="container">
                                            <h3 class="section-title mt-5">Need a template?</h3>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 col-sm-12 py-5">
                                                    <img class="mt-auto mb-auto" src="images/PosterTemplate_potrait.jpg" alt="Template">
                                                </div>
                                                <div class=" col-lg-4 col-md-6 col-sm-12 py-5 mx-auto">
                                                    <div class="container">
                                                        <h3 class="section-title mt-5">Template</h3>
                                                        <div class="underline"></div>
                                                        <div class="col-lg-12">
                                                            <div class="py-3 d-flex">
                                                                <div class="pb-5 icon bg-info text-white"><i class="material-icons">
                                                                        cloud_download
                                                                    </i></div>
                                                                <div class="pl-4">
                                                                    <h5>Download our template now</h5>
                                                                    <p>Available in both portrait and landscape formats to support your event needs</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="py-4 px-4 d-flex justify-content-center">
                                                            <a href="images/PosterTemplate_potrait.jpg" download>
                                                                <button type="button" class="btn btn-info btn-pill mt-4 mx-2">Portrait</button>
                                                            </a>
                                                            <a href="images/PosterTemplate_landscape.jpg" download>
                                                                <button type="button" class="btn btn-info btn-pill mt-4 mx-2">Landscape</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
</main>

<!-- Form validation Script -->
<script>
    (function() {
        'use strict';

        window.addEventListener('load', function() {

            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>