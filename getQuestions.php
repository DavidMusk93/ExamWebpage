<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/4/26
 * Time: 12:02
 */
header("Content-Type:application/json; charset=UTF-8");  // the difference between getAllQuestion.php & getQuestions.php
include_once 'connection.php';

$sql0 = "SELECT count(*) FROM questions WHERE isRequired='Y'";
$result0 = db_query($sql0);
echo $result0->lengths;

// $unrequiredNum =30 - (int)($result0->fetch_all()[0][0]);
$unrequiredNum =30;

$sql = "SELECT * FROM questions WHERE isRequired='Y'";
$result = db_query($sql);
// $result->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data[] = array(
        'id' => $row['id'],
        'header' => $row['header'],
        'opts' => $row['opts'],
        'answer' => $row['answer']
    );
    $unrequiredNum -= 1;
}

$sql1 = "SELECT * FROM questions WHERE isRequired='N' ORDER BY RAND() LIMIT $unrequiredNum";
$result1 = db_query($sql1);
// $result->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
    $data[] = array(
        'id' => $row['id'],
        'header' => $row['header'],
        'opts' => $row['opts'],
        'answer' => $row['answer'],
        // 'answer' => urlencode($row['answer'])
    );
}

shuffle($data);
for ($i = 1; $i <= count($data); $i++) {
    $data[$i - 1]['order'] = 'select' . $i;
}
// echo count($data);
echo json_encode($data);