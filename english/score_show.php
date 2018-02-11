<html>
    <body>
	<?php
	session_start();

	$con = mysql_connect('localhost','account','password');
	$db = mysql_select_db('english',$con);

	$sql="select * from qlist where qname=\"".$_SESSION['qname']."\"";
	$result = mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	$answer=$row['answer'];
	$qid=$row['qID'];

	$sql="select * from user_qlist where username=\"".$_SESSION['name']."\" and qID=\"".$qid."\" and useranswer not like '%0%' order by answerdate desc limit 1";

	$result = mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	$useranswer=$row['useranswer'];
	$repeat=$row['answerrepeat'];
	if ($repeat=="") {
	    $repeat=0;
	}
	$score=0;
	$score_R=0;
	$score_L=0;
	for ($i=0;$i<100;$i++){
	    if(substr($answer,$i,1)==substr($useranswer,$i,1)){
		$score_L=$score_L+5;
	    }
	}
	for ($i=100;$i<200;$i++){
	    if(substr($answer,$i,1)==substr($useranswer,$i,1)){
		$score_R=$score_R+5;
	    }
	}
	$score=$score_L+$score_R;

	print "<h1>Total Score ".$score." / Listening ".$score_L." / Reading ".$score_R." / Try ".$repeat."</h1><br>\n";

	if ($useranswer){
	    print "<table style=\"font-size:40px;width:100%\">\n";
	    print "<tr><td>No.</td><td>answer</td><td>your answer</td></tr>\n";
	    for ($i=0;$i<200;$i++){
		$no=$i+1;
		if(substr($answer,$i,1)!=substr($useranswer,$i,1)){
		    print "<tr width=100%><td width=30%>".$no."</td><td width=35%>".substr($answer,$i,1)."</td><td width=35%>".substr($useranswer,$i,1)."</td></tr>\n";
		}
	    }
	    print "</table>\n";
	}

	mysql_close($con);

	?>
    </body>
</html>
