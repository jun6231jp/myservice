<?php
session_start();
if (!$_SESSION['name']){
    exit;
}

header('Content-Type: application/json charset=UTF-8');

$name=$_POST['name'];
$string=$_POST['str'];

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('hhab',$con);
$len=strlen($string);
for ($i=0;$i<$len;$i++)
{
    $flag=substr($string,$i,1);

    if ($flag=="1"){
	$sql="select * from useruse where userID=\"".$name."\" order by time limit 1 offset ".$i;
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$date=$row['time'];

	$sql="update useruse set class=0 where userID=\"".$name."\" and time=\"".$date."\"";
	$result = mysql_query($sql);
    }else{
	$result = true;
    }
}
echo $string;
mysql_close($con);
?>	
