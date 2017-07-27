<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/4/21
 * Time: 14:39
 */
//echo phpinfo();
//define('DB_NAME', 'sqlsrv:Server=127.0.0.1,1433;Database=exam');
//define('DB_USER', 'sa');
//define('DB_PWD', 'Ss123456');
//
//try {
//    $conn = new PDO(DB_NAME, DB_USER, DB_PWD);
//    if ($conn) {
//        echo "Database connect succeed.<br />";
//    }
//} catch (PDOException $e) {
//    $content = iconv("UTF-8", "gbk", $e->getMessage());
//    echo $content . "<br />";
//}
//
//$connectionInfo = array("Database" => DB_NAME, "UID" => DB_USER, "PWD" => DB_PWD);
//$conn = sqlsrv_connect(DB_HOST, $connectionInfo);
//
//if ($conn) {
//    echo "Connection is established.<br />";
//} else {
//    echo "Connection could not be established.<br />";
//    die(print_r(sqlsrv_errors(), true));
//}
/*echo "<table style='border: solid 1px black;'>";
echo "<tr><th>id</th><th>header</th><th>opts</th><th>answer</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px;border: 1px solid black;'>". parent::current() . "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "root";
$password = "Ss123456";
$dbname = "exam";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO (PHP Data Objects) mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, header, opts, answer FROM questions");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
//    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
echo "</table>";*/

include_once 'connection.php';

$query = 'SELECT id FROM questions';
$ids = db_select($query);
if ($ids === false) {
    echo 'connection is not established.';
} else {
    $newID = generate_id($ids);
    // var_dump($newID);
}

// generate a special id to maximize the order of ids
function generate_id($ids) {
    $id = null;
    for ($i = 1; $i < (int)(end($ids)['id']) + 1; $i++) {
        $id = (int)($ids[$i - 1]['id']);
        if ($i !== $id) {
            return str_pad((string)($i), 4, '0', STR_PAD_LEFT);
        }
    }

    return str_pad((string)((int)(end($ids)['id']) + 1), 4, '0', STR_PAD_LEFT);
}

$data_json = file_get_contents('php://input');  // $_POST doesn't work here
$response = json_decode($data_json, true);  // decoding received JOSN array
// echo $response;  // back end can not transfer array to front end
$header = db_quote($response['header']);
$options = db_quote($response['options']);
$answer = db_quote($response['answer']);
$isRequired = db_quote($response['isRequired']);
// echo $header;

if ($data_json) {
    $insert_query = "INSERT INTO questions VALUES ('$newID', $header, $options, $answer, $isRequired)";
    // echo $insert_query;
}

if (db_query($insert_query)) {
    echo "Insert success.";
} else {
    echo "Insert failure.";
}


