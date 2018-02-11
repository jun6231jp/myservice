<?php

header('Content-Type: application/json charset=UTF-8');
$id = $_POST['id'];
$name = $_POST['name'];
$msg=$_POST['msg'];
$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('shogi',$con);
$sql = "insert into chat (id , name , msg) values (".$id.",\"".$name."\",\"".$msg."\")";
$result = mysql_query($sql);
if ($result){
    $data="success";
    echo json_encode(compact(data));
}
mysql_close($con);
