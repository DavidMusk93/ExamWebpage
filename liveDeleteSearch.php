<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/5/12
 * Time: 22:14
 */

$xmlDoc = new DOMDocument();
$xmlDoc->load('allQuestions.xml');

$x = $xmlDoc->getElementsByTagName('question');

$q = $_GET['q'];  // get the q parameter from URL

if (strlen($q) > 0) {
    $hint = '';
    for ($i = 0; $i < ($x->length); $i++) {
        $id = $x->item($i)->getElementsByTagName('id')->item(0)->childNodes->item(0)->nodeValue;
        $header = $x->item($i)->getElementsByTagName('header');
        $opts = $x->item($i)->getElementsByTagName('opts')->item(0)->childNodes->item(0)->nodeValue;
        $answer = $x->item($i)->getElementsByTagName('answer')->item(0)->childNodes->item(0)->nodeValue;
        $isRequired = $x->item($i)->getElementsByTagName('isRequired')->item(0)->childNodes->item(0)->nodeValue;
        if ($header->item(0)->nodeType == 1) {
            if (stristr($header->item(0)->childNodes->item(0)->nodeValue, $q)) {
                $hint = $hint . '<button type="button" class="btn btn-warning btn-block" id = "deleteSearchList'
                    . $id . '" ' . 'onclick="autoPadding(this.id)" style="margin-bottom: 0px">'
                    . $header->item(0)->childNodes->item(0)->nodeValue . '</button>'
                    . '<div class="well" style="text-align: left; display: none" id="dPaddingValue' . $id . '">'
                    . $opts . '&' . $answer . '&' . $isRequired . '</div>';
                /*if ($hint == '') {
                    $hint = '<button type="button" class="btn btn-info btn-block" id = "updateSearchList'
                        . $id . '" ' . 'onclick="showUpdate(this.id)" style="margin-bottom: 0px">'
                        . $header->item(0)->childNodes->item(0)->nodeValue . '</button>'
                        . '<div class="well" style="text-align: left; display: none" id="paddingValue"' . $id . '">'
                        . $opts . '&' . $answer . '&' . $isRequired . '</div>';
                } else {
                    $hint = $hint . '<button type="button" class="btn btn-info btn-block" id = "updateSearchList' . $id->item(0)->childNodes->item(0)->nodeValue . '" ' . 'onclick="showUpdate(this.id)" style="margin-bottom: 0px">' . $header->item(0)->childNodes->item(0)->nodeValue . '</button>';
                }*/
            }
        }
    }

    if ($hint == "") {
        $response = '<div class="alert alert-danger alert-dismissable" style="text-align: left; margin-bottom: 5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><i>No Suggestion</i></div>';
    } else {
        $response = $hint;
    }

    echo $response;
}
