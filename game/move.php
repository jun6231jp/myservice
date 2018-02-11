<?php

header('Content-Type: application/json charset=UTF-8');

$id=$_POST['id'];
$str=$_POST['str'];
$before=$_POST['before'];
$after=$_POST['after'];
$teban=$_POST['teban'];
$nari=$_POST['nari'];
$query = "/home/user/C/move.out";
for ($i=0;$i<121;$i++){
    $piece=substr($str,$i*2,2);
    if (substr($piece,0,1)=="0")
    {
	$piece=substr($str,$i*2+1,1);
    }
    $query = $query." ".$piece;    
}
$query = $query." ".$before;
$query = $query." ".$after;
$query = $query." ".$teban;
$query = $query." ".$nari;
$output=exec($query);
if ($output != "")
{
    $ban=substr($output,0,162);
    $oki=substr($output,162,80);
    $con = mysql_connect('localhost','account','password'); 
    $db = mysql_select_db('shogi',$con);
    $sql = "update ban set banmen='".$ban."',oki='".$oki."',teban=".$teban." where id=".$id;
    $result = mysql_query($sql);
    $sql = "insert into kifu (id , banmen , oki) values (".$id." , '".$ban."' , '".$oki."')";
    $result = mysql_query($sql);
    $sql = "update highlight set ban=".$after." where id=".$id;
    $result = mysql_query($sql);    
    if ($result){
	$data=$output;
	echo json_encode(compact(data));
    }
}
mysql_close($con);
