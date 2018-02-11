<?php

header('Content-Type: application/json charset=UTF-8');

$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('english',$con);
$qid=intval($_POST['qid']);
$ans=$_POST['str'];
session_start();
$username=$_SESSION['name'];

$sql="select count(*) from user_qlist where username=\"".$username."\" and qID=".$qid;
$result=mysql_query($sql);
$row = mysql_fetch_assoc($result);
$count=intval($row['count(*)']);
if ($count==0){
    $repeat=0;
}else{
    $sql="select max(answerrepeat) from user_qlist where username=\"".$username."\" and qID=".$qid;
    $result=mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $repeat=intval($row['max(answerrepeat)']);
    if (!strstr($ans,'0')){
	$repeat=$repeat+1;
    }
}
$sql="insert into user_qlist (username,qID,answerrepeat,useranswer,answerdate) value (\"".$username."\",".$qid.",".$repeat.",\"".$ans."\",now())";

$result = mysql_query($sql);

if ($result){
    $data = "registration success!";
    echo json_encode(compact('data'));
}

mysql_close($con);
