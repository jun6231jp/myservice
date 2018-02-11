<?php
session_start();
if (!$_SESSION['name']){
    exit;
}

header('Content-Type: application/json charset=UTF-8');

$name=$_POST['name'];
$money=$_POST['money'];
$item=$_POST['item'];
$budget=$_POST['budget'];

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('hhab',$con);

$sql="insert into useruse (userID,time,money,item,class) value (\"".$name."\",now(),".$money.",\"".$item."\",".$budget.")";
$result = mysql_query($sql);

if ($result){
    $data="success";
    echo json_encode(compact('data'));
} else {
    $data="fail";
    echo json_encode(compact('data'));
}
mysql_close($con);
?>	
