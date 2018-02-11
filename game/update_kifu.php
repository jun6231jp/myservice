<?php

header('Content-Type: application/json charset=UTF-8');

$id=$_POST['id'];
$teban=$_POST['teban'];

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('shogi',$con);

$sql = "select count(*) from kifu where id=".$id;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$count = $row['count(*)'];

if (intval($count) > intval($teban)){
    $sql = "select * from kifu where id=".$id." limit 1 offset ".$teban;
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $ban = $row['banmen'];
    $oki = $row['oki'];
    $output = $ban.$oki;
    
    $sql = "select * from heya where id=".$id;
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $sente = $row['sente'];
    $gote = $row['gote'];
    
    $data=[];
    $data[]=$output;
    $data[]=$sente;
    $data[]=$gote;
    
    if ($result){
	echo json_encode(compact(data));
    }
    mysql_close($con);
}
