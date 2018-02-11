<?php
session_start();
if ($_FILES["upfile"]["name"]){
    $file_tmp  = $_FILES["upfile"]["tmp_name"];
    $file_save = "../files/" . $_FILES["upfile"]["name"];
    $result = @move_uploaded_file($file_tmp, $file_save);
    $con = mysql_connect('localhost','account','password'); 
    $db = mysql_select_db('shikaku',$con);
    $sql="select max(id) from wordlist";
    $result= mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    if ($result) {
	$sql="update wordlist set fig=\"".$_FILES["upfile"]["name"]."\" where id={$_SESSION['id']}";
	$result= mysql_query($sql);
	
	if ( $result ) {
	    echo "file:".$_FILES["upfile"]["name"];
	} else {
	    echo "$sql";
	}
    }
    else {
	echo "max ng";
    }
}
else {
    echo "no file";
}
mysql_close($con);
?>
