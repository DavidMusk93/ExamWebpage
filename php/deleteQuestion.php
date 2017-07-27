<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/5/13
 * Time: 15:32
 */
$q = str_pad($_GET['q'], 4, '0', STR_PAD_LEFT);
// echo $q;

$delete_query = "DELETE FROM questions WHERE id=$q";

include_once '../connection.php';

if (db_query($delete_query)) {
    echo "Delete success.";
} else {
    echo "Delete failure.";
}