<?php
session_start();
if (!$_SESSION['name']){
    exit;
}
?>

<html lang="ja">
    <meta charset="utf-8">
    <body>

	<table width="100%" border=1>
	    <?php

	    $con = mysql_connect('localhost','account','password'); 
	    $db = mysql_select_db('shikaku',$con);

	    $result= mysql_query('select count(word) from wordlist');
	    $row = mysql_fetch_assoc($result);
	    $line=$row['count(word)'];


	    for ($count=0;$count<$line;$count++){
		print "<tr>\n";
		$result= mysql_query('select * from wordlist limit 1 offset '.$count);
		$row = mysql_fetch_assoc($result);
		$id=$count+1;
		$word=$row['word'];
		$ex=nl2br($row['ex']);
		$fig=$row['fig'];
		if($fig != NULL){
		    print "<td width=\"5%\">".$id."</td><td width=\"20%\">".$word."</td><td width=\"60%\">".$ex."</td><td><img src=\"../files/".$fig."\" width=\"400\" height=\"400\"></td>\n";
		} else {
		    print "<td width=\"5%\">".$id."</td><td width=\"20%\">".$word."</td><td width=\"45%\">".$ex."</td><td></td>\n";
		}
		print"</tr>\n";
	    }


	    mysql_close($con);
	    ?>
	</table>

	<input type="button" id="execute" value="back" onClick="location.href='index.php'" style="font-size:30px"><br>

    </body>
</html>

