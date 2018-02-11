<?php
session_start();
if (!$_SESSION['name']){
    exit;
}
$serviceid=$_SESSION['serviceid'];
if ($serviceid > 100000){
    $serviceid=$serviceid-100000;
}
if ($serviceid > 10000){
    $serviceid=$serviceid-10000;
}
if ($serviceid > 1000){
    $serviceid=$serviceid-1000;
}
if ($serviceid > 100){
    $serviceid=$serviceid-100;
}
if ($serviceid < 10){
    exit;
}

?>
<!DOCTYPE html>
<html>
    <head>

	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<meta charset=utf-8 />
	<title>Chart</title>
    </head>


    <body>
	Score<br>
	<div id="myfirstchart"></div>
	<br>
	Score of Listening<br>
	<div id="mythirdchart"></div>
	<br>
	Score of Reading<br>
	<div id="myfourthchart"></div>
	<br>

	State of progress<br>
	<div id="mysecondchart"></div>
	<br>

	<script>
	 new Morris.Area({
	     element: 'myfirstchart',

	     data: [
		 <?php

		 $con = mysql_connect('localhost','account','password');
		 $db = mysql_select_db('english',$con);

		 $sql="select count(qID) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $line=$row['count(qID)'];

		 $sql="select count(useranswer) from user_qlist where useranswer not like '%0%'";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $trueline=$row['count(useranswer)'];

		 $sql="select count(distinct username) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $usernum=$row['count(distinct username)'];

		 for ($i=0;$i<$trueline;$i++){

		     $sql="select * from user_qlist where useranswer not like '%0%' limit 1 offset ".$i ;
		     $result=mysql_query($sql);
		     $row=mysql_fetch_assoc($result);
		     $date=$row['answerdate'];
		     $qid=$row['qID'];
		     $useranswer=$row['useranswer'];
		     $user=$row['username'];

		     print <<< EOM
		     { week: '
EOM;
print $date;
print <<< EOM
', 
		       EOM;
			 for ($j=0;$j<$usernum;$j++){

			     $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			     $result=mysql_query($sql);
			     $row=mysql_fetch_assoc($result);
			     $usertemp=$row['username'];

			     if($user != $usertemp){
				 $sql="select * from user_qlist where answerdate < \"".$date."\" and username=\"".$usertemp."\" and useranswer not like '%0%' order by answerdate desc limit 1";
				 $result=mysql_query($sql);
				 $row=mysql_fetch_assoc($result);
				 $answertemp=$row['useranswer'];
				 $qidtemp=$row['qID'];
			     }else {
				 $usertemp=$user;
				 $answertemp=$useranswer;
				 $qidtemp=$qid;
			     }
			     if ($answertemp =="") {
				 $answertemp=0;
				 $score=0;
			     }else {
				 $sql="select * from qlist where qID= ".$qidtemp ;
				 $result=mysql_query($sql);
				 $row=mysql_fetch_assoc($result);
				 $answer=$row['answer'];
				 $score=0;
				 for ($k=0;$k<200;$k++){
				     if(substr($answertemp,$k,1)==substr($answer,$k,1)){
					 $score=$score+5;
				     }
				 }
			     }
			     print "'";
			     print $usertemp;
			     print "'";
			     print ":";
			     print "'";
			     print $score;
			     print "'";
			     if ($j != $usernum-1){
				 print ",";
			     }
			 }
			 print "}";
			 if($i < $trueline-1){
			     print ",\n";
			 }
		     }
		     print <<< EOM

		 ],
		 xkey: 'week',
		 ykeys: ['
EOM;

for ($j=0;$j<$usernum;$j++){

$sql="select distinct username from user_qlist limit 1 offset ".$j ;
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$usertemp=$row['username'];

print $usertemp;
print "'";
if($j!=$usernum-1){
print ",'";
}
}
print "],\n";
print <<<EOM
  labels: ['
		     EOM;
		     for ($j=0;$j<$usernum;$j++){

			 $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			 $result=mysql_query($sql);
			 $row=mysql_fetch_assoc($result);
			 $usertemp=$row['username'];

			 print $usertemp;
			 print "'";
			 if($j!=$usernum-1){
			     print ",'";
			 }
		     }
		     print "]";
		 ?>

	 });
	</script>


	<script>
	 new Morris.Area({
	     element : 'mysecondchart',
	     data: [
		 <?php
		 $con = mysql_connect('localhost','account','password');
		 $db = mysql_select_db('english',$con);

		 $sql="select count(answerdate) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $line=$row['count(answerdate)'];

		 $sql="select count(distinct username) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $usernum=$row['count(distinct username)'];


		 for ($i=0;$i<$line;$i++) {
		     $sql="select answerdate,username,length(replace(useranswer,'0','')) from user_qlist limit 1 offset ".$i ;
		     $result=mysql_query($sql);
		     $row=mysql_fetch_assoc($result);
		     $date=$row['answerdate'];
		     $progress=$row['length(replace(useranswer,\'0\',\'\'))'];
		     $user=$row['username'];
		     print <<< EOM
		     { week: '
EOM;
print $date;
print <<< EOM
',
		       EOM;

			 $linecount=0;
			 for ($j=0;$j<$usernum;$j++){

			     $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			     $result=mysql_query($sql);
			     $row=mysql_fetch_assoc($result);
			     $usertemp=$row['username'];

			     $sql="select answerdate,username,length(replace(useranswer,'0','')) from user_qlist limit 1 offset ".$i ;
			     $result=mysql_query($sql);
			     $row=mysql_fetch_assoc($result);
			     $datetemp=$row['answerdate'];
			     //$usertemp=$row['username'];
			     $progress= $row['length(replace(useranswer,\'0\',\'\'))'];

			     if($user != $usertemp){
				 $sql="select answerdate,username,length(replace(useranswer,'0','')) from user_qlist where answerdate < \"".$datetemp."\" and username=\"".$usertemp."\" order by answerdate desc limit 1";
				 $result=mysql_query($sql);
				 $row=mysql_fetch_assoc($result);
				 $datetemp=$row['answerdate'];
				 //$usertemp=$row['username'];
				 $progress=$row['length(replace(useranswer,\'0\',\'\'))'];
			     }

			     $sql="select count(useranswer) from user_qlist where username=\"".$usertemp."\" and length(replace(useranswer,'0','')) = 200 and answerdate < \"".$datetemp."\"";
			     $result=mysql_query($sql);
			     $row=mysql_fetch_assoc($result);
			     $repeat=$row['count(useranswer)'];

			     $sql="select sum(progress) from (select qID,answerdate,username,max(length(replace(useranswer,'0',''))) as progress from user_qlist where username='".$usertemp."' and answerdate <= '".$datetemp."' group by qID) as prtbl";

			     //$progress=intval($progress) + 200*intval($repeat);
			     $result=mysql_query($sql);
			     $row=mysql_fetch_assoc($result);
			     $progress=intval($row['sum(progress)']);

			     print "'";
			     print $usertemp;
			     print "'";
			     print ":";
			     print "'";
			     print $progress;
			     print "'";
			     if ($j != $usernum-1){
				 print ",";
			     }
			 }
			 print "}";
			 $linecount=$linecount+1;
			 if($linecount < $line){
			     print ",\n";
			 }
		     }

		     print <<< EOM

		 ],
		 xkey: 'week',
		 ykeys: ['
EOM;

for ($j=0;$j<$usernum;$j++){

$sql="select distinct username from user_qlist limit 1 offset ".$j ;
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$usertemp=$row['username'];

print $usertemp;
print "'";
if($j!=$usernum-1){
print ",'";
}
}
print "],\n";
print <<<EOM
  labels: ['
		     EOM;
		     for ($j=0;$j<$usernum;$j++){

			 $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			 $result=mysql_query($sql);
			 $row=mysql_fetch_assoc($result);
			 $usertemp=$row['username'];

			 print $usertemp;
			 print "'";
			 if($j!=$usernum-1){
			     print ",'";
			 }
		     }
		     print "]";
		 ?>
	 });	
	</script>


	<script>
	 new Morris.Area({
	     element: 'mythirdchart',

	     data: [
		 <?php

		 $con = mysql_connect('localhost','account','password');
		 $db = mysql_select_db('english',$con);

		 $sql="select count(qID) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $line=$row['count(qID)'];

		 $sql="select count(useranswer) from user_qlist where useranswer not like '%0%'";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $trueline=$row['count(useranswer)'];

		 $sql="select count(distinct username) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $usernum=$row['count(distinct username)'];

		 for ($i=0;$i<$trueline;$i++){

		     $sql="select * from user_qlist where useranswer not like '%0%' limit 1 offset ".$i ;
		     $result=mysql_query($sql);
		     $row=mysql_fetch_assoc($result);
		     $date=$row['answerdate'];
		     $qid=$row['qID'];
		     $useranswer=$row['useranswer'];
		     $user=$row['username'];

		     print <<< EOM
		     { week: '
EOM;
print $date;
print <<< EOM
',
		       EOM;
			 for ($j=0;$j<$usernum;$j++){

			     $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			     $result=mysql_query($sql);
			     $row=mysql_fetch_assoc($result);
			     $usertemp=$row['username'];

			     if($user != $usertemp){
				 $sql="select * from user_qlist where answerdate < \"".$date."\" and username=\"".$usertemp."\" and useranswer not like '%0%' order by answerdate desc limit 1";
				 $result=mysql_query($sql);
				 $row=mysql_fetch_assoc($result);
				 $answertemp=$row['useranswer'];
				 $qidtemp=$row['qID'];
			     }else {
				 $usertemp=$user;
				 $answertemp=$useranswer;
				 $qidtemp=$qid;
			     }
			     if ($answertemp =="") {
				 $answertemp=0;
				 $score=0;
			     }else {
				 $sql="select * from qlist where qID= ".$qidtemp ;
				 $result=mysql_query($sql);
				 $row=mysql_fetch_assoc($result);
				 $answer=$row['answer'];
				 $score=0;
				 for ($k=0;$k<100;$k++){
				     if(substr($answertemp,$k,1)==substr($answer,$k,1)){
					 $score=$score+5;
				     }
				 }
			     }
			     print "'";
			     print $usertemp;
			     print "'";
			     print ":";
			     print "'";
			     print $score;
			     print "'";
			     if ($j != $usernum-1){
				 print ",";
			     }
			 }
			 print "}";
			 if($i < $trueline-1){
			     print ",\n";
			 }
		     }
		     print <<< EOM

		 ],
		 xkey: 'week',
		 ykeys: ['
EOM;

for ($j=0;$j<$usernum;$j++){

$sql="select distinct username from user_qlist limit 1 offset ".$j ;
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$usertemp=$row['username'];

print $usertemp;
print "'";
if($j!=$usernum-1){
print ",'";
}
}
print "],\n";
print <<<EOM
  labels: ['
		     EOM;
		     for ($j=0;$j<$usernum;$j++){

			 $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			 $result=mysql_query($sql);
			 $row=mysql_fetch_assoc($result);
			 $usertemp=$row['username'];

			 print $usertemp;
			 print "'";
			 if($j!=$usernum-1){
			     print ",'";
			 }
		     }
		     print "]";
		 ?>

	 });
	</script>


	<script>
	 new Morris.Area({
	     element: 'myfourthchart',

	     data: [
		 <?php

		 $con = mysql_connect('localhost','account','password');
		 $db = mysql_select_db('english',$con);

		 $sql="select count(qID) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $line=$row['count(qID)'];

		 $sql="select count(useranswer) from user_qlist where useranswer not like '%0%'";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $trueline=$row['count(useranswer)'];

		 $sql="select count(distinct username) from user_qlist";
		 $result=mysql_query($sql);
		 $row=mysql_fetch_assoc($result);
		 $usernum=$row['count(distinct username)'];

		 for ($i=0;$i<$trueline;$i++){

		     $sql="select * from user_qlist where useranswer not like '%0%' limit 1 offset ".$i ;
		     $result=mysql_query($sql);
		     $row=mysql_fetch_assoc($result);
		     $date=$row['answerdate'];
		     $qid=$row['qID'];
		     $useranswer=$row['useranswer'];
		     $user=$row['username'];

		     print <<< EOM
		     { week: '
EOM;
print $date;
print <<< EOM
',
		       EOM;
			 for ($j=0;$j<$usernum;$j++){

			     $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			     $result=mysql_query($sql);
			     $row=mysql_fetch_assoc($result);
			     $usertemp=$row['username'];

			     if($user != $usertemp){
				 $sql="select * from user_qlist where answerdate < \"".$date."\" and username=\"".$usertemp."\" and useranswer not like '%0%' order by answerdate desc limit 1";
				 $result=mysql_query($sql);
				 $row=mysql_fetch_assoc($result);
				 $answertemp=$row['useranswer'];
				 $qidtemp=$row['qID'];
			     }else {
				 $usertemp=$user;
				 $answertemp=$useranswer;
				 $qidtemp=$qid;
			     }
			     if ($answertemp =="") {
				 $answertemp=0;
				 $score=0;
			     }else {
				 $sql="select * from qlist where qID= ".$qidtemp ;
				 $result=mysql_query($sql);
				 $row=mysql_fetch_assoc($result);
				 $answer=$row['answer'];
				 $score=0;
				 for ($k=100;$k<200;$k++){
				     if(substr($answertemp,$k,1)==substr($answer,$k,1)){
					 $score=$score+5;
				     }
				 }
			     }
			     print "'";
			     print $usertemp;
			     print "'";
			     print ":";
			     print "'";
			     print $score;
			     print "'";
			     if ($j != $usernum-1){
				 print ",";
			     }
			 }
			 print "}";
			 if($i < $trueline-1){
			     print ",\n";
			 }
		     }
		     print <<< EOM

		 ],
		 xkey: 'week',
		 ykeys: ['
EOM;

for ($j=0;$j<$usernum;$j++){

$sql="select distinct username from user_qlist limit 1 offset ".$j ;
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$usertemp=$row['username'];

print $usertemp;
print "'";
if($j!=$usernum-1){
print ",'";
}
}
print "],\n";
print <<<EOM
  labels: ['
		     EOM;
		     for ($j=0;$j<$usernum;$j++){

			 $sql="select distinct username from user_qlist limit 1 offset ".$j ;
			 $result=mysql_query($sql);
			 $row=mysql_fetch_assoc($result);
			 $usertemp=$row['username'];

			 print $usertemp;
			 print "'";
			 if($j!=$usernum-1){
			     print ",'";
			 }
		     }
		     print "]";
		 ?>

	 });
	</script>

    </body>

</html>
