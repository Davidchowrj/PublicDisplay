<?php

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // For processing the login:
    require ('login_functions.inc.php');
    require ('includes/DbConnect.php');

    // Check the login:
    list ($check, $data) = check_login($con, $_POST['email'], $_POST['password']);

    if ($check) { // OK!
        list($role, $role_data) = check_role($con, $data['user_id']);
        if($role){
            // Set the cookies:
            setcookie("user_id",$data['user_id']);
            setcookie("name",$data['user_name']);
            setcookie("role_id",$role_data['role_id']);
            setcookie("email",$data['user_email']);

            // Redirect:
            if($role_data['role_id']!=1){
                redirect_user('contributorIndex.php');
            }

            if($role_data['role_id']==1){
                redirect_user('adminIndex.php');
            }

        }
    } else { // Unsuccessful!

        // Assign $data to $errors for error reporting
        // in the login_page.inc.php file.
        $errors = $data;

    }

    mysqli_close($con); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('login_page.inc.php');