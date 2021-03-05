<?php

$random_salt_length = 32;
/**
 * Queries the database and checks whether the user already exists
 *
 * @param $email
 *
 * @return false
 */
function userExists($email)
{
    $query = "SELECT user_id FROM users WHERE user_email = ?";
    global $con;
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->close();
            return true;
        }
        $stmt->close();
    }
    return false;
}

/**function emailExists($email)
{
    $query = "SELECT user_id FROM users WHERE user_email = ?";
    global $con;
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->close();
            return true;
        }
        $stmt->close();
    }
    return false;
}**/

/**
 * Creates a unique Salt for hashing the password
 *
 * @return bin2hex
 */
function getSalt()
{
    global $random_salt_length;
    return bin2hex(openssl_random_pseudo_bytes($random_salt_length));
}

/**
 * Creates password hash using the Salt and the password
 *
 * @param $password
 * @param $salt
 *
 * @return
 */
function concatPasswordWithSalt($password, $salt)
{
    global $random_salt_length;
    if ($random_salt_length % 2 == 0) {
        $mid = $random_salt_length / 2;
    } else {
        $mid = ($random_salt_length - 1) / 2;
    }
    return
        substr($salt, 0, $mid - 1) . $password . substr($salt, $mid, $random_salt_length - 1);
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}