<?php

define('DB_SERVER', "localhost"); // db server
define('DB_USER', "oscsa_pd"); // db user
define('DB_PASSWORD', "CodeCamp@19"); // db password
define('DB_DATABASE', "oscsa_pd"); // database name


$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);


if(mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

date_default_timezone_set('Asia/Kuala_Lumpur');