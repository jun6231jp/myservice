<?php

header('Content-Type: application/json charset=UTF-8');

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('shikaku',$con);
if ($_POST['id']){
    if ($_POST['word']){
	if ($_POST['ex']){
	    $sql = "update wordlist set word = '{$_POST['word']}', ex = '{$_POST['ex']}' where id = {$_POST['id']}";
	    $result = mysql_query($sql);
	} else {
	    $sql = "update wordlist set word = '{$_POST['word']}' where id = {$_POST['id']}";
	    $result = mysql_query($sql);
	}
    } else {
	if ($_POST['ex']){
	    $sql = "update wordlist set ex = '{$_POST['ex']}' where id = {$_POST['id']}";
	    $result = mysql_query($sql);
	} else { 
	    $result="none";
	}
    }
} else {
    $result="none";
}

if($result){
    $data = "{$_POST['word']}:{$_POST['ex']}";
    echo json_encode(compact('data'));
}
mysql_close($con);
session_start();
$_SESSION['id']=$_POST['id'];


