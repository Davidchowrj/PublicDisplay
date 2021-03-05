<?php

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
    echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
    foreach ($errors as $msg) {
        echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In </title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <!-- Fav icon-->
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">

</head>

<body class="text center">

<img class=" logo ml-5 my-5" src="images/big logo.png" alt="logo" height="48" href="index.php">
<form class="form-signin" action="login.php" method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-5 text-center">Log In</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input name="email" type="email" class="form-control mb-1" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" class="form-control mb-5" placeholder="Password" required>

    <!-- Buttons-->
    <div class="row">
        <div class="col-12">
            <input class="btn btn-small btn-primary btn-block" type="submit" name="signin"
                   style="border-radius: 16px; font-size:18px;" value="Sign In"
            </input>
            <i class="la la-bars"></i>
        </div>
    </div>
</form>
</body>
</html>
