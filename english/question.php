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
        <meta charset="utf-8">
        <title>TOEIC list</title>
    </head>

    <style>
     input {
	 max-width:100%;
	 font-size:50px;
     }
     .sw {
	 width: 100%;
	 height: 170px;
     }
     .sw2 {
	 width:100%;
	 height:150px;
	 font-size:40px;
     }
    </style>



    <body>


	<p>
	    <input type="submit" class="sw" id="Qreg" value="TOEIC registration" onClick="location.href='Qreg.php'"></input>
	</p>

	<table style="font-size:40px" width=100%>
	    <?php
	    session_start();
	    $con = mysql_connect('localhost','account','password');
	    $db = mysql_select_db('english',$con);

	    $result= mysql_query('select count(qID) from qlist');
	    $row = mysql_fetch_assoc($result);
	    $line=$row['count(qID)'];


	    for ($count=0;$count<$line;$count++){
		print "<tr>\n";
		$result= mysql_query('select * from qlist order by qname limit 1 offset '.$count);
		$row = mysql_fetch_assoc($result);
		$id=$count+1;
		$qname=trim($row['qname']);
		$qid=$row['qID'];
		$sql="select * from user_qlist where username=\"{$_SESSION['name']}\" and qID=".$qid." order by answerdate desc limit 1";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		$repeat=$row['answerrepeat'];
		print "<td width=\"10%\">".$id."</td><td width=\"85%\"><input type=\"submit\" value=\"".$qname."\" id=\"button".$id."\" class=\"sw2\"></td><td>".$repeat."</td>\n";
		print"</tr>\n";
	    }

	    mysql_close($con);

	    print <<< EOM
	    </table>
	    <p>
	    <input type="submit" value="top" onClick="location.href='./'" class="sw">
	    </p>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	    <script>

	    $(function () {

		EOM;
		for ($count=0;$count<$line;$count++) {
		    $id=$count+1;

		    print <<< EOM
		    $('#button
EOM;
print $id;
print <<< EOM
').click(function () {
	    if (window.confirm('Are you sure?')){
		var qname=document.getElementById("button
EOM;
print $id;
print <<< EOM
").value;
		$.ajax({
		    url: 'answer_buffer.php',
		    type: 'post',
		    dataType: 'json',
		    data: {
			qname:qname
                    }
		})
               .done(function (response) {
		   alert(response.data);
		   location.href='answerform.php';
               })
               .fail(function () {
		   alert('err');
               });
            }
	    });

		    EOM;
		}
		print <<< EOM
	    });

	    </script>

	    EOM;

	    ?>
    </body>
</html>
