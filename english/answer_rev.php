<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	<title>answer form</title>

	<style>
	 body.reg {
	     background-color:#FFCCFF;
	 }
	 input {
	     width:100%;
	     font-size:50px;
	 }
	 .big { width:48pt; height:48pt; }
	 td {
	     text-align:center;
	     margin-right:auto; 
	     margin-left:auto;
	 }
	 .id {
	     text-align:left;
	 }
	</style>


	<?php
	session_start();
	$serviceid=$_SESSION['serviceid'];

	$con = mysql_connect('localhost','account','password','service'); 
	$db = mysql_select_db('english',$con);
	$sql = "select * from qlist where qname=\"{$_SESSION['qname']}\"";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$flag=$row['flag'];
	$qid=$row['qID'];
	$_SESSION['qid']=$qid;
	$ans=$row['answer'];
	mysql_close($con);


	print "<body class=\"reg\">\n";

	print "<h1>Registration {$_SESSION['qname']}</h1>\n";
	print "<form id=\"qtable\"><table width=\"100%\" style=\"font-size:50px\">";
	for ($i=0;$i<200;$i++){

	    $ca="";
	    $cb="";
	    $cc="";
	    $cd="";
	    if ($ans != "") {
		$char=substr($ans,$i,1);
		if ($char=="A"){
		    $ca="checked";
		}
		if ($char=="B"){
		    $cb="checked";
		}
		if ($char=="C"){
		    $cc="checked";
		}
		if ($char=="D"){
		    $cd="checked";
		}
	    }

	    print "<tr><td class=\"id\" width=\"20%\">";
	    print $i+1;
	    print <<< EOM
	    </td>

	    <td width="20%">A<input type="checkbox" id="chkA
EOM;
$num=$i;
print $num;
print <<< EOM
" class="big" 
	    EOM;
	    print $ca;
	    print <<< EOM
	    ></td>

	    <td width="20%">B<input type="checkbox" id="chkB
EOM;
$num=$i;
print $num;
print <<< EOM
" class="big" 
	    EOM;
	    print $cb;
	    print <<< EOM
	    ></td>

	    <td width="20%">C<input type="checkbox" id="chkC
EOM;
$num=$i;
print $num;
print <<< EOM
" class="big" 
	    EOM;
	    print $cc;
	    print <<< EOM
	    ></td>

	    <td width="20%">D<input type="checkbox" id="chkD
EOM;
$num=$i;
print $num;
print <<< EOM
" class="big" 
	    EOM;
	    print $cd;
	    print <<< EOM
	    ></td></tr>

	    EOM;

	}

	print <<< EOM
	</table>

	<p>
	<input type="submit" id="commit" value="commit">
	</p>
	</form>
	<p><input type="button" id="portal" value="back" onClick="location.href='question_rev.php'" style="width:100%;font-size:50px"></p>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>

	$(function () {
	    $('#commit').click(function () {
		if (window.confirm('Are you sure?')){

		    EOM;

		    print <<< EOM
		    var qid=
			EOM;
		    print $_SESSION['qid'];
		    print <<< EOM
		    ;
		    var str="";

		    EOM;
		    for ($i=0;$i<200;$i++) {
			print <<< EOM
			if(document.forms.qtable.chkA
			    EOM;
			    print $i;
			    print <<< EOM
				 .checked){
			    str= str + "A";
			} else if(document.forms.qtable.chkB
			    EOM;
			    print $i;
			    print <<< EOM
				 .checked){
			    str= str + "B";
			} else if(document.forms.qtable.chkC
			    EOM;
			    print $i;
			    print <<< EOM
				 .checked){
			    str= str + "C";
			} else if(document.forms.qtable.chkD
			    EOM;
			    print $i;
			    print <<< EOM
				 .checked){
			    str= str + "D";
			} else {
			    str= str + "0";
			}

			EOM;
		    }

		    print <<< EOM

		    $.ajax({
			url: 'answer_reg.php',
			type: 'post',
			dataType: 'json',
			data: {
			    qid:qid,
			    str:str
			}
		    })
			 .done(function (response) {
			     alert(response.data);
			 })
			 .fail(function () {
			     alert('done');
			 });
		}
	    });
	});

	</script>

	EOM;
	?>
</body>
</html>
