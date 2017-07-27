<?php
/**
 * Created by PhpStorm.
 * User: davidmusk
 * Date: 6/15/2017
 * Time: 9:28 PM
 */
// start the session
session_start();

include_once '../connection.php';

$dataTransfer = file_get_contents('php://input');
// echo $dataTransfer;
$loginInfo = json_decode($dataTransfer, true);

// you should purge data when you write data in database;
$username = db_quote($loginInfo['username']);
$password = $loginInfo['password'];  // escape password is inappropriate.
// var_dump($password);

$sql = 'SELECT * FROM user WHERE username = ' . $username;
// echo $sql;

$result = db_query($sql);

if (!$result) {
    echo false;
} else {
    while ($correspondingUserInfo = $result->fetch_array(MYSQLI_ASSOC)) {
        // echo var_dump($correspondingUserInfo['password']);
        // verify password for corresponding user
        if (strcmp($password, $correspondingUserInfo['password']) !== 0) {
            echo false;
        } else {
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            echo $_SESSION['token'];
            echo '&' . $correspondingUserInfo['available'];
        }
    };
}