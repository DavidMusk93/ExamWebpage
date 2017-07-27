<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/4/26
 * Time: 11:56
 */
function db_connect() {
    // define connection as a static variable, to avoid connecting more than once
    static $connection;

    // Try and connect to the database, if a connection has not been established yet
    if (!isset($connection)) {
        // load configuration as an array
        $config = parse_ini_file('config.ini');
        $connection  = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
    }

    if ($connection === false) {
        // handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error();
    }
    return $connection;
}

function db_query($query) {
    // connect to the database
    $connection = db_connect();
    $connection->query('SET NAMES utf8');

    // Query the database
    $result = mysqli_query($connection, $query);

    return $result;
}

function db_error() {
    $connection = db_connect();
    return mysqli_error($connection);
}

function db_select($query) {
    $rows = array();
    $result = db_query($query);

    if ($result === false) {
        return false;
    }

    // if query was successful, retrieve all the rows into a array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// escaping dynamic values and user input
function db_quote($value) {
    $connection = db_connect();
    return "'" . mysqli_real_escape_string($connection, $value) . "'";
}

//try {
//    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//    // set the PDO (PHP Data Objects) mode to exception
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    if (!$conn) {
//        echo "Connection is not established.";
//    }
//} catch (PDOException $e) {
//    echo "Error: " . $e->getMessage();
//}
