<?php
session_start();

if (!isset($_COOKIE['user_id'])) {

    // Need the function:
    require ('login_functions.inc.php');
    redirect_user('login.php');

} else { // Delete the cookies:
    setcookie('name','', time()-3600);
    setcookie('user_id','', time()-3600);
    require ('login_functions.inc.php');
    redirect_user('index.php');
}
