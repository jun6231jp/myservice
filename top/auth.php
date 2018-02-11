<?php

header('Content-Type: application/json');
@session_start();
$_SESSION['name']=$_POST['name'];
$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('service',$con);
$sql = "select * from user where username=\"{$_POST['name']}\" and passwd=password('{$_POST['pass']}')";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$username=$row['username'];
if($username!=""){
    $data = "welcome! {$_SESSION['name']}";
    echo json_encode(compact('data'));
}
mysql_close($con);
