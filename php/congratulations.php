<?php
/**
 * Created by PhpStorm.
 * User: davidmusk
 * Date: 6/20/2017
 * Time: 9:45 PM
 */

// start the session
session_start();

include_once '../connection.php';

$dataTransfer = file_get_contents('php://input');
// echo $dataTransfer;
$userInfo = json_decode($dataTransfer, true);

// you should purge data when you write data in database;
$username = db_quote($userInfo['username']);

// echo true;  // we could return boolean to forth end
// echo false;  // conclusion above is incorrect...
if ($_SESSION['token'] === $userInfo['token']) {
    // echo $_SESSION['token'];
    $sql = 'UPDATE user SET available = "Y" WHERE username = ' . $username;
    // echo $sql;

    $result = db_query($sql);

    if (!$result) {
        echo '';
    } else {
        echo "pass";
    }
} else {
    echo '';
}