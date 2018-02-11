<?php

header('Content-Type: application/json charset=UTF-8');

$id=$_POST['id'];
$teban=$_POST['teban'];
$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('shogi',$con);
$sql = "update resign set teban=".intval($teban)." where id=".$id;
$result = mysql_query($sql);
if ($result){
    $data="resigned";
    echo json_encode(compact(data));
}
mysql_close($con);
