<?php
require_once 'includes/DbConnect.php';
require_once 'includes/functions.php';

if (isset($_POST['add_user'])) {
    $full_name = $_POST['uName'];
    $email = $_POST['uEmail'];
    $org = $_POST['uOrg'];
    $password = $_POST['uPass'];

    if (!userExists($email)) {
        //Get a unique Salt
        $salt = getSalt();
        //Generate a unique password Hash
        $passwordHash = password_hash(concatPasswordWithSalt($password, $salt), PASSWORD_DEFAULT);

        $date = date('Y-m-d H:i:s');

        $addQuery = "INSERT INTO `users`(`user_name`, `user_email`, `user_pass_hash`,`user_pass_salt`,`user_org`,`user_created_at`) VALUES ('$full_name','$email','$passwordHash','$salt', '$org','$date')";
        $user_idQuery = "SELECT `user_id` FROM `users` WHERE `user_email` = '$email'";

        if (mysqli_query($con, $addQuery)) {
            //echo "<p>User successful created</p>";
            $user_id_result = mysqli_query($con, $user_idQuery);
            if (mysqli_num_rows($user_id_result) == 1) {
                $row = mysqli_fetch_array($user_id_result, MYSQLI_ASSOC);
                $user_id = $row["user_id"];
                if (!empty($user_id)) {
                    $role_id = $_POST['uType'];
                    $roleQuery = "INSERT INTO `user_role`(`user_id`,`role_id`) values ('$user_id','$role_id')";
                    if (mysqli_query($con, $roleQuery)) {
                        echo "<script type='text/javascript'>alert('Successful added');</script>";
                    } else {
                        echo mysqli_error($con);
                    }
                } else {
                    echo mysqli_error($con);
                }
            } else {
                echo mysqli_error($con);
                //echo "<script type='text/javascript'>alert('Error');</script>";
            }
        } else {
            //echo "<script type='text/javascript'>alert('User Exists');</script>";
            echo "<p>User Exists</p>";
        }
    }
}

// Create the page:
include('add_user_page.inc.php');

