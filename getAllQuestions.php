<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/5/9
 * Time: 10:59
 */
header("Content-Type:application/json; charset=UTF-8");

include_once 'connection.php';

$query = "SELECT * FROM questions";
$result = db_query($query);
// var_dump($result);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data[] = array(
        'id' => (int)$row['id'],
        /*'header' => urlencode($row['header']),
        'opts' => urlencode($row['opts']),*/
        'header' => $row['header'],
        'opts' => $row['opts'],
        'answer' => $row['answer'],
        'isRequired' => $row['isRequired'],
        'activeAnswer' => activeOptions($row['answer'], 4),
        'activeIsRequired' => activeOptions($row['isRequired'], 2),
    );
}
function activeOptions($answer, $quantity) {
    $order = ord($answer) - 65;
    $arr = [];
    if ($quantity === 4) {
        for ($i = 0; $i < $quantity; $i++) {
            $arr[$i] = ($i === $order? true : false);
        }
    } else {
            $arr[0] = (ord($answer) - 89) === 0? true : false;
            $arr[1] = !$arr[0];
    }
    return $arr;
};

// var_dump(activeOptions('D', 4));
// echo urldecode(json_encode($data));
echo json_encode($data);

foreach ($data as $question) {
    $question  = array_diff_key($question, ['activeAnswer' => 'xy', 'activeIsRequired' => 'xy']);
    $dataArray[] = $question;
}

include_once "createXML.php";
// var_dump(createXML($dataArray, $str));
//$dom = new DOMDocument();
//$dom->loadXML(createXML1($dataArray));
//$dom->formatOutput = true;
//$formattedXML = $dom->saveHTML();
file_put_contents('allQuestions.xml', createXML1($dataArray));  // Single log in is required, multiple users would change the solo file.