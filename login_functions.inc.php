<?php
function redirect_user($page)
{

    // Start defining the URL...
    // URL is http:// plus the host name plus the current directory:
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // Remove any trailing slashes:
    $url = rtrim($url, '/\\');

    // Add the page:
    $url .= '/' . $page;

    // Redirect the user:
    header("Location: $url");
    exit(); // Quit the script.

} // End of redirect_user() function.

function concatPasswordWithSalt($password, $salt)
{
    $random_salt_length = 32;
    if ($random_salt_length % 2 == 0) {
        $mid = $random_salt_length / 2;
    } else {
        $mid = ($random_salt_length - 1) / 2;
    }
    return
        substr($salt, 0, $mid - 1) . $password . substr($salt, $mid, $random_salt_length - 1);
}

function check_login($dbc, $email = '', $pass = ''){
    // Validate the email address:
    if (empty($email)){
        $errors[] = ' Your forgot to enter your email address. ';
    }

    // Validate the password:
    if (empty($pass)){
        $errors[] = ' Your forgot to enter your password. ';
    }

    if (empty($errors)) { // If everything's OK.
        $errors = array();

        $password_hash = null;
        $salt = null;

        $query = "SELECT * FROM users WHERE user_email = '$email'";

        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);

            $password_hash = $row["user_pass_hash"];
            $salt = $row["user_pass_salt"];

            if (!empty($password_hash) && !empty($salt)) {
                $concatpass = concatPasswordWithSalt($pass, $salt);
                if (password_verify($concatpass, $password_hash)) {
                    return array(true, $row);
                } else {
                    $errors[] = 'Invalid username and password combination';
                    //echo "<script type='text/javascript'>alert('Invalid username and password combination');</script>";
                }
            } else {
                $errors[] = 'Data is empty';
                //echo "<script type='text/javascript'>alert('Data is empty');</script>";
            }
        } else {
            $errors[] = 'No Such User';
            //echo "<script type='text/javascript'>alert('No Such User');</script>";
        }
    }

    return array(false, $errors);
}

function check_role($dbc, $uid = ''){
    $errors = array();
    $query = "SELECT * FROM user_role WHERE user_id = '$uid'";
    $result = mysqli_query($dbc, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
        return array(true, $row);
    }
    return array(false, $errors);
}