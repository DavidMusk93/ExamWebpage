<?php
/**
 * Created by PhpStorm.
 * User: davidmusk
 * Date: 6/16/2017
 * Time: 9:18 PM
 */
// start the session
session_start();

include_once '../connection.php';

$dataTransfer = file_get_contents('php://input');
// echo $dataTransfer;
$refreshInfo = json_decode($dataTransfer, true);

// you should purge data when you write data in database;
$username = db_quote($refreshInfo['username']);

if ($_SESSION['token'] === $refreshInfo['token']) {
    // echo $_SESSION['token'];
    $sql = 'SELECT * FROM user WHERE username = ' . $username;
    // echo $sql;

    $result = db_query($sql);

    if (!$result) {
        echo false;
    } else {
        while ($correspondingUserInfo = $result->fetch_array(MYSQLI_ASSOC)) {
            // echo var_dump($correspondingUserInfo['password']);
            // verify password for corresponding user
            echo $correspondingUserInfo['available'];
        };
    }
} else {
    echo false;
}