<?php

header('Content-Type: application/json charset=UTF-8');

$maxid=$_POST['maxid'];
$con = mysql_connect('localhost','account','password'); 
$db = mysql_select_db('service',$con);

$rescount=0;
for ($i=0;$i<$maxid/5;$i++){
    $usernum=$i+1;
    $sql = "select * from user where userID=".$usernum;
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $username=$row['username'];
    $datstr="";
    for ($j=1;$j<6;$j++){
	$datid="dat".($i*5+$j);
	$datstr=$datstr.$_POST["{$datid}"];
    }

    $datstr=intval($datstr);
    if ($username=="Admin"){
	$datstr=$datstr+100000;
    }
    $sql = "update servicelist set serviceid=".$datstr." where username=\"".$username."\"";
    $result = mysql_query($sql);
    if ($result){
	$rescount++;
    }else{
	$rescount=$i;
	break;
    }
}

mysql_close($con);

if($rescount==$maxid/5){
    $data = "success!";
    echo json_encode(compact('data'));
}
else{
    $data = $rescount;
    echo json_encode(compact('data'));
}
