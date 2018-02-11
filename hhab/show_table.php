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
	<form id="hhabform">
	    <?php

	    $con = mysql_connect('localhost','account','password'); 
	    $db = mysql_select_db('hhab',$con);

	    $sql="select sum(money) from useruse where userID=\"".$_SESSION['name']."\" and time > curdate() group by userID";
	    $result=mysql_query($sql);
	    $row=mysql_fetch_assoc($result);
	    $todaymoney=$row['sum(money)'];
	    if ($todaymoney==""){
		$todaymoney=0;
	    }

	    $sql="select year(now())";
	    $result=mysql_query($sql);
	    $row=mysql_fetch_assoc($result);
	    $year=$row['year(now())'];
	    $sql="select month(now())";
	    $result=mysql_query($sql);
	    $row=mysql_fetch_assoc($result);
	    $month=$row['month(now())'];
	    if ($month < 10) {
		$month="0".$month;
	    }

	    $sql="select count(*) from useruse where userID=\"".$_SESSION['name']."\" and time >= '".$year."-".$month."'";
	    $result= mysql_query($sql);
	    $row = mysql_fetch_assoc($result);
	    $line=$row['count(*)'];

	    $sql="select sum(money) from useruse where userID=\"".$_SESSION['name']."\" and time >= '".$year."-".$month."'";

	    $result=mysql_query($sql);
	    $row=mysql_fetch_assoc($result);
	    $monthmoney=$row['sum(money)'];
	    if ($monthmoney==""){
		$monthmoney=0;
	    }

	    $sql="select count(*) from useruse where userID=\"".$_SESSION['name']."\" and time < '".$year."-".$month."'";
	    $result=mysql_query($sql);
	    $row=mysql_fetch_assoc($result);
	    $preline=$row['count(*)'];

	    $sql="select sum(money) from useruse where userid=\"".$_SESSION['name']."\" and class=1";
	    $result=mysql_query($sql);
	    $row=mysql_fetch_assoc($result);
	    $checkmoney=$row['sum(money)'];
	    if ($checkmoney==""){
		$checkmoney=0;
	    }

	    $sql="select goal from goals where userid=\"".$_SESSION['name']."\"";
	    $result=mysql_query($sql);
	    $row=mysql_fetch_assoc($result);
	    $goal=$row['goal'];
	    if ($goal==""){
		$goal=0;
	    }

	    print "<table width=\"100%\" style=\"font-size:60px\">";
	    print "<tr><td>本日の使用額</td><td>".$todaymoney."円</td></tr>";
	    print "<tr><td>今月の使用額</td><td>".$monthmoney."円</td></tr>";

	    if ($goal != 0){
		$remain = $goal - $monthmoney;
		print "<tr><td>目標残額</td><td>".$remain."円</td></tr>";
	    }
	    if ($checkmoney!=0){
		print "<tr><td>未精算額</td><td>".$checkmoney."円</td></tr>";
	    }
	    print "</table><br>\n";

	    print <<< EOM
	    <table width="100%" id="hhabtable" style="font-size:30px">

	    EOM;
	    $chkflag=0;
	    for ($count=0;$count<$line;$count++){
		$result= mysql_query('select * from useruse where userID="'.$_SESSION['name'].'" and time > "'.$year.'-'.$month.'" order by time limit 1 offset '.$count);
		$row = mysql_fetch_assoc($result);
		$id=$count+1;
		$date=$row['time'];
		$money=$row['money'];
		$item=$row['item'];
		$class=$row['class'];

		if ($class == 0){

		    print "<tr style=\"border:solid 1px;\">\n";
		    print "<td width=\"10%\">".$id."</td><td width=\"20%\">".$money."円</td><td width=\"30%\">".$item."</td><td width=\"30%\">".$date."</td><td width=\"10%\"></td>\n";
		}
		else {
		    $chkflag=1;
		    print "<tr bgcolor=\"paleturquoise\" style=\"border:solid 1px;\">\n";
		    print "<td width=\"10%\">".$id."</td><td width=\"20%\">".$money."円</td><td width=\"30%\">".$item."</td><td width=\"30%\">".$date."</td><td width=\"10%\"><input type=\"checkbox\" id=\"chk".($count+$preline)."\" class=\"big\"></td>\n";

		}
		print"</tr>\n";
	    }

	    mysql_close($con);
	    print "</table><br>";
	    if($chkflag==1){
		print <<< EOM
		<p>
		<input type="button" id="commit" value="精算" class="button">
		</p>

		EOM;
	    }

	    if ($checkmoney!=0){
		print <<< EOM
		<p>
		<input type="button" id="allcommit" value="まとめて精算" class="button">
		</p>

		EOM;


	    }

	    ?>
	    <p>
		<input type="button" id="history" value="履歴" onClick="location.href='history.php'" class="button">
	    </p>
	    <p>
		<input type="button" id="content" value="内訳" onClick="location.href='content.php'" class="button">
	    </p>
	    <p>
		<input type="button" id="back" value="戻る" onClick="location.href='index.php'" class="button">
	    </p>
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>

	 $(function () {
	     $('#allcommit').click(function(){
		 if (window.confirm('Are you sure?')){
		     <?php
		     session_start();
		     print "var name = \"".$_SESSION['name']."\";\n";
		     ?>

		     $.ajax({
			 url:'allpayoff.php',
			 type: 'post',   
			 dataType: 'json',
			 data: {name : name}
		     })
		      .done ( function() {
			  alert('success');
			  location.href='show_table.php';
		      })
		      .fail (function () {
			  alert('done');
			  location.href='show_table.php';   
		      }); 
		 }
	     });
	 });
	 $(function(){
	     $('#commit').click(function () {
		 if (window.confirm('Are you sure?')){
		     <?php

		     $con = mysql_connect('localhost','account','password'); 
		     $db = mysql_select_db('hhab',$con);
		     $sql="select count(*) from useruse where userID=\"".$_SESSION['name']."\"";
		     $result= mysql_query($sql);
		     $row = mysql_fetch_assoc($result);
		     $line=$row['count(*)'];

		     $sql="select year(now())";
		     $result=mysql_query($sql);
		     $row=mysql_fetch_assoc($result);
		     $year=$row['year(now())'];
		     $sql="select month(now())";
		     $result=mysql_query($sql);
		     $row=mysql_fetch_assoc($result);
		     $month=$row['month(now())'];
		     if ($month < 10) {
			 $month="0".$month;
		     }

		     $sql="select count(*) from useruse where userID=\"".$_SESSION['name']."\" and time < '".$year."-".$month."'";
		     $result=mysql_query($sql);
		     $row=mysql_fetch_assoc($result);
		     $preline=$row['count(*)'];

		     print "var str=\"\";\n";

		     for ($i=0 ; $i < $preline ; $i++) 
		     {
			 print <<< EOM
			 str = str + "0";

			 EOM;
		     }

		     for ($i=$preline;$i<$line;$i++)
		     {
			 $result= mysql_query('select * from useruse where userID="'.$_SESSION['name'].'" limit 1 offset '.$i);

			 $row = mysql_fetch_assoc($result);
			 $class=$row['class'];
			 if ($class==1){
			     print "if (document.forms.hhabform.chk".$i.".checked)";
			     print <<< EOM
			     {
				 str = str + "1";
			     } else {
				 str = str + "0";
			     }

			     EOM;
			 }else{
			     print "str = str + \"0\";\n";
			 }
		     }
		     session_start();
		     print "var name = \"".$_SESSION['name']."\";\n";
		     mysql_close($con);

		     ?>
		     $.ajax({
			 url: 'payoff.php',
			 type: 'post',
			 dataType: 'json',
			 data: {
			     name: name,
			     str: str
			 }
		     })
		      .done(function () {
			  alert('success');
			  location.href='show_table.php';
		      })
		      .fail(function () {
			  alert('done');
			  location.href='show_table.php';
		      });

		 }
	     });
	 });

	</script>
    </body>
</html>

