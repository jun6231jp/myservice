<?php
session_start();
if (!$_SESSION['name']){
    exit;
}

header('Content-Type: application/json charset=UTF-8');

$word=trim(lcfirst($_POST['word']));
$wordtemp=str_replace(' ','+',$word);
$output=shell_exec("sh /home/user/search.sh ".$wordtemp);

if (strlen($output)>2){
    $con = mysql_connect('localhost','account','password'); 
    $db = mysql_select_db('english',$con);

    $sql="select count(*) from wordlist where word=\"".$word."\" and username=\"{$_SESSION['name']}\"";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $flag=$row['count(*)'];

    if ($flag>0){
	$sql="select count from wordlist where word=\"".$word."\" and username=\"{$_SESSION['name']}\"";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$count=$row['count']+1;
	$sql="select memo from wordlist where word=\"".$word."\" and username=\"{$_SESSION['name']}\"";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$memo=$row['memo'];
	if ($memo == ""){
	    $sql="update wordlist set memo=\"{$_POST['memo']}\" where word=\"".$word."\" and username=\"{$_SESSION['name']}\"";
	    $result = mysql_query($sql);
	}

	$sql="update wordlist set count=".$count." where word=\"".$word."\" and username=\"{$_SESSION['name']}\"";

    }else{
	$count=1;

	$sql = "insert into wordlist (word,ex,username,count,memo) value (\"".$word."\",\"".$output."\",\"{$_SESSION['name']}\",".$count.",\"{$_POST['memo']}\")";
    }

    $result = mysql_query($sql);
    $data = $output;
    echo json_encode(compact('data'));

    mysql_close($con);

} else {
    $data="no data";
    echo json_encode(compact('data'));
}
