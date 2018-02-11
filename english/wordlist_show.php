<?php
session_start();
if (!$_SESSION['name']){
    exit;
}
?>


<html>
    <meta charset="utf-8">
    <body>

	<table width="100%" border=1 style="font-size:20px">
	    <?php

	    $con = mysql_connect('localhost','account','password'); 
	    $db = mysql_select_db('english',$con);
	    $sql="select count(word) from wordlist where username=\"{$_SESSION['name']}\"";
	    $result= mysql_query($sql);
	    $row = mysql_fetch_assoc($result);
	    $line=$row['count(word)'];

	    for ($count=0;$count<$line;$count++){
		print "<tr>\n";
		$sql="select * from wordlist where username=\"{$_SESSION['name']}\" limit 1 offset ".$count;
		$result= mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$id=$count+1;
		$word=trim($row['word']);
		$repeat=$row['count'];
		$word_pro=preg_replace("/( |  )/","",trim($row['word']));
		$ex=$row['ex'];
		$memo=$row['memo'];
		print "<td width=\"5%\">".$id."</td><td width=\"15%\">".$word."</td><td width=\"40%\">".$ex."</td><td width=\"30%\">".$memo."</td><td width=\"5%\">".$repeat."</td>\n";
		//<td width=\"10%\"><audio src=\"https://ssl.gstatic.com/dictionary/static/sounds/de/0/".$word_pro.".mp3\" controls style=\"width:120px; height:90px;\"></audio></td><td width=\"5%\">".$repeat."</td>\n";
		print"</tr>\n";
	    }

	    mysql_close($con);
	    ?>
	</table>

	<input type="button" id="execute" value="back" onClick="location.href='word.php'" style="font-size:30px"><br>

    </body>
</html>

