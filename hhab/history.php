<?php
session_start();
if (!$_SESSION['name']){
    exit;
}
?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <title>House Hold Account Book</title>
    <style>
     input.button {
         height: 120px;
         font-size:60px;
         width: 100%;
     }
     .big { width:40px; height:40px; }
     table 	{
	 border-collapse:collapse
     }
    </style>
    <body>
	<?php

	$con = mysql_connect('localhost','account','password'); 
	$db = mysql_select_db('hhab',$con);

	$sql="select count(*) from ( select DATE_FORMAT(time, \"%Y-%m\"),sum(money) from useruse where userID=\"".$_SESSION['name']."\" group by DATE_FORMAT(time, \"%Y%m\") ) as X";
	$result= mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$line=$row['count(*)'];

	print <<< EOM
	<table width="100%" id="hhabtable" style="font-size:30px">

	EOM;

	for ($count=0;$count<$line;$count++){
	    $sql="select DATE_FORMAT(time, \"%Y-%m\"),sum(money) from useruse where userID=\"".$_SESSION['name']."\" group by DATE_FORMAT(time, \"%Y%m\") limit 1 offset ".$count;

	    $result= mysql_query($sql);
	    $row = mysql_fetch_assoc($result);
	    $date=$row['DATE_FORMAT(time, "%Y-%m")'];
	    $money=$row['sum(money)'];

	    print "<tr style=\"border:solid 1px;\">\n";
	    print "<td width=\"30%\">".$date."</td><td width=\"20%\">".$money."円</td>\n";
	    print"</tr>\n";
	}

	mysql_close($con);
	print "</table><br>";

	?>

	<p>
	    <input type="button" id="back" value="戻る" onClick="location.href='show_table.php'" class="button">
	</p>

    </body>
</html>

