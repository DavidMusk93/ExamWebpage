<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/5/9
 * Time: 14:45
 */
$str = <<<XML
<?xml version="1.0" encoding="utf-8" ?>
<questionsBank></questionsBank>
XML;

/* thanks to http://www.phppan.com/2009/10/use-php-create-xml-file/ */
function createXML($dataArray, $str) {
    $xml = simplexml_load_string($str);
    foreach ($dataArray as $data) {
        $question = $xml->addChild('question');
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $question->addChild($key, $value);
            }
        }
    }
    return $xml->asXML();
}

function createXML1($dataArray) {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><questionsBank/>');

    foreach ($dataArray as $question) {
        $item = $xml->addChild('question');
        if (is_array($question)) {
            foreach ($question as $key => $value) {
                $item->addChild($key, $value);
            }
        }
    }

    return $xml->asXML();
}

//$data_array = array(
//    array(
//        'title' => 'title1',
//        'content' => 'content1',
//        'pubdate' => '2009-10-11',
//    ),
//    array(
//        'title' => 'title2',
//        'content' => 'content2',
//        'pubdate' => '2009-11-11',
//    )
//);
//
//echo createXML($data_array, $str);
//echo createXML1($data_array);