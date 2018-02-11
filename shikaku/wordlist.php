<?php

header('Content-Type: application/json charset=UTF-8');

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('shikaku',$con);
$sql = "insert into wordlist (word,ex) value (\"{$_POST['word']}\",\"{$_POST['ex']}\")";
$result = mysql_query($sql);
if($result){
    $data = "{$_POST['word']}:{$_POST['ex']}";
    echo json_encode(compact('data'));
}
mysql_close($con);
