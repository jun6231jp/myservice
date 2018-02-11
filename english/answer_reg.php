<?php

header('Content-Type: application/json charset=UTF-8');

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('english',$con);
$qid=intval($_POST['qid']);
$ans=$_POST['str'];

$sql = "update qlist set answer=\"{$_POST['str']}\" where qID=".$qid;

$result = mysql_query($sql);

if (!strstr($ans,'0')){
    $sql = "update qlist set flag=1 where qID=".$qid;
    $result = mysql_query($sql);
}

mysql_close($con);

if ($result){
    $data = "registration success!";
    echo json_encode(compact('data'));
}
