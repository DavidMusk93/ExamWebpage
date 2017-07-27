<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/5/13
 * Time: 13:13
 */
include_once '../connection.php';

$data_json = file_get_contents('php://input');  // $_POST doesn't work here
$response = json_decode($data_json, true);  // decoding received JOSN array
// echo $response;  // back end can not transfer array to front end
$id = str_pad($response['id'], 4, '0', STR_PAD_LEFT);
$header = db_quote($response['header']);
$options = db_quote($response['options']);
$answer = db_quote($response['answer']);
$isRequired = db_quote($response['isRequired']);
// echo $header;

if ($data_json) {
    $update_query = "Update questions SET header=$header, opts=$options, answer=$answer, isRequired=$isRequired WHERE id=$id";
    // echo $update_query;
}

if (db_query($update_query)) {
    echo "Update success.";
} else {
    echo "Update failure.";
}