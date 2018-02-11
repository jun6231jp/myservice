<?php

header('Content-Type: application/json charset=UTF-8');

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('english',$con);

$sql = "insert into qlist (qname,answer,flag) value (\"{$_POST['qname']}\",\"000\",0)";

$result = mysql_query($sql);
if ($result){
    $data = "{$_POST['qname']} registration success!";
    echo json_encode(compact('data'));
}

mysql_close($con);
