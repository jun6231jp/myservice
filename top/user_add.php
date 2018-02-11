<?php

header('Content-Type: application/json');
$con = mysql_connect('localhost','account','password','service'); 
if ($_POST['name'] != "" && strlen($_POST['name']) < 20){
    $sql = "select * from user where username=\"{$_POST['name']}\"";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $username=$row['username'];
    if(!$username){
	$db = mysql_select_db('service',$con);
	$sql = "select max(userID) from user";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$maxid=$row['max(userID)'];
	$nextid=$maxid + 1;
	$sql = "insert into user (userID, username, passwd) values (\"".$nextid."\",\"{$_POST['name']}\", password('{$_POST['pass']}'))";
	$result = mysql_query($sql);
	$sql = "select * from user where username=\"{$_POST['name']}\"";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$username=$row['username'];
	if($username!=""){
	    $data = $username." created successfully!";
	    shell_exec("echo {$_POST['name']} | mail -s user_addition a.miki.21.29.0232@gmail.com");
	    $sql = "insert into servicelist (username, serviceid) values (\"{$_POST['name']}\", 0)";
	    $result = mysql_query($sql);
	    if($result){
		echo json_encode(compact('data'));
	    }
	}
    }
}
mysql_close($con);

