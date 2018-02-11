<?php
session_start();
if (!$_SESSION['name']){
    exit;
}

header('Content-Type: application/json charset=UTF-8');

$name=$_POST['name'];
$money=$_POST['money'];

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('hhab',$con);
$sql="select count(*) from goals where userID=\"".$name."\"";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$count=$row['count(*)'];
if ($count > 0){
    $sql="update goals set goal=".$money." where userID=\"".$name."\"";
} else {
    $sql="insert into goals (userID , goal) values (\"".$name."\" , ".$money.")";
}
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
