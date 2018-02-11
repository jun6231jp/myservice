<?php

header('Content-Type: application/json charset=UTF-8');

$id=$_POST['id'];
$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('shogi',$con);
$sql = "select * from ban where id=".$id;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$ban = $row['banmen'];
$oki = $row['oki'];
$teban = $row['teban'];
$output = $ban.$oki.$teban;

$sql = "select * from heya where id=".$id;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$sente = $row['sente'];
$gote = $row['gote'];

$sql = "select * from resign where id=".$id;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$resign=$row['teban'];

$sql = "select * from highlight where id=".$id;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$highlight=$row['ban'];

$data=[];
$data[]=$output;
$data[]=$sente;
$data[]=$gote;
$data[]=$resign;
$data[]=$highlight;

$sql = "select count(*) from chat where id=".$id;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$count=$row['count(*)'];
if ($count==0){
    for ($i = 0;$i < 10;$i++)
    {
	$data[]="";
    }
}
else
{
    for ($i = 0;$i < 5;$i++)
    {
	if($count<5){
	    $sql = "select * from chat where id=".$id." limit 1 offset ".$i;
	}
	else
	{
	    $sql = "select * from chat where id=".$id." limit 1 offset ".($count-5+$i);
	}
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$msg = $row['msg'];
	$name = $row['name'];
	if ($msg==NULL)
	{
	    $msg="";
	    $name="";
	}
	else if($name==NULL)
	{
	    $name="nanasi";
	}
	$data[]=$name;
	$data[]=$msg;
    }
}
if ($result){
    echo json_encode(compact(data));
}
mysql_close($con);
