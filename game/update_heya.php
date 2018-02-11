<?php

header('Content-Type: application/json charset=UTF-8');

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('shogi',$con);
$data=[];
for ($i=1;$i<4;$i++)
{
    $sql = "select * from heya where id=".$i;
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $sente = $row['sente'];
    $gote = $row['gote'];
    $data[]=$sente;
    $data[]=$gote;
}
echo json_encode(compact(data));
mysql_close($con);
