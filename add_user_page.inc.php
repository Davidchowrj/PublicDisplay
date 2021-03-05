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

$title = 'Add User Manually';
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
                <div class="col-lg-8 col-sm-12 col-md-8 text-center text-sm-left">
                    <span class="text-uppercase page-title mb-4">Add New User</span>
                    <div class="section">
                        <div class="row">
                            <div class="col-lg-auto col-md-auto col-sm-auto">
                                <button onclick="window.location.href = 'user_management.php?status=0';">New request</button>
                                <button onclick="window.location.href = 'user_management.php?status=1';">Approved request</button>
                                <button onclick="window.location.href = 'user_management.php?status=2';">Reject request</button>
                                <button onclick="window.location.href = 'user_management.php?member';">All user</button>
                                <button onclick="window.location.href = 'add_user.php';">Manually Add New User</button>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row-fluid">
                                <form class="needs-validation" novalidate action="add_user.php" method="post" enctype="multipart/form-data">
                                    <div class="my-3">
                                        <label for="Name">User Full Name</label>
                                        <input type="text" class="form-control" name="uName" id="uName" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid full name.
                                        </div>
                                    </div>


                                    <div class="my-3">
                                        <label for="Email">User Email</label>
                                        <input type="email" class="form-control" name="uEmail" id="uEmail" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please enter the correct email.
                                        </div>
                                    </div>

                                    <div class="my-3">
                                        <label for="Organization">User Organization</label>
                                        <input type="text" class="form-control" name="uOrg" id="uOrg" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please enter the correct organization.
                                        </div>
                                    </div>

                                    <div class="my-3">
                                        <label for="Password">User Password</label>
                                        <input type="password" class="form-control" name="uPass" id="uPass" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please enter the correct Password.
                                        </div>
                                    </div>

                                    <div class="my-3">
                                        <label for="UserType">User Type</label>
                                        <select class="custom-select d-block w-100" name="uType" required>
                                            <option value=""> -Please Select User Type-</option>
                                            <option value="1"> Admin</option>
                                            <option value="2"> Content Contributor</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an Event Type.
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-sm-12">

                                    <!--<div class="col-lg-6 col-md-12 sm-12">
                                                <button onclick="goBack()" class="btn btn-info btn-lg btn-block mb-5">Previous Page</button>
                                            </div>-->

                                    <button class="btn btn-info  btn-block mb-auto" type="submit" name="add_user" id="add_user">Add</button>

                                </div>
                            </div>
                        </div>
                        </form>
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