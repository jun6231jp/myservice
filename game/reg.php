<?php

header('Content-Type: application/json charset=UTF-8');

$id=intval($_POST['heya']);
session_start();
$_SESSION['heya']=$id;
$name=$_POST['name'];
$num=intval($_POST['num']);
$con = mysql_connect('localhost','account','passowrd'); 
$db = mysql_select_db('shogi',$con);
if (($num % 2) == 1)
{
    $_SESSION['myteban']=0;
    $sql = "update heya set sente='".$name."' where id=".$id;
}
else
{    
    $_SESSION['myteban']=1;
    $sql = "update heya set gote='".$name."' where id=".$id;
}
$result = mysql_query($sql);
if ($result){
    $data="start";
    echo json_encode(compact(data));
}
mysql_close($con);
