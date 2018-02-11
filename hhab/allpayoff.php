<?php
session_start();
if (!$_SESSION['name']){
    exit;
}

header('Content-Type: application/json charset=UTF-8');

$name=$_POST['name'];

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('hhab',$con);

$sql="update useruse set class=0 where userID=\"".$name."\" and class=1";
$result = mysql_query($sql);

echo $name;
mysql_close($con);

?>	
