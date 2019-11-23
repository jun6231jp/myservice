<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title>user control</title>

<style>
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
.name {
text-align:left;
}
</style>

<body>

<?php
session_start();
$serviceid=$_SESSION['serviceid'];
if ($serviceid < 100000){
exit;
}
$con = mysql_connect('localhost','root','rootroot','service');
$db = mysql_select_db('service',$con);
$sql = "select max(userID) from user";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$maxid=$row['max(userID)'];

print <<< EOM
<form id="servicetable">
<table style="font-size:30pt;width:80%;margin-right:auto; margin-left:auto;">
<tr style="text-align:center">
<td></td>
<td>hhab</td>
<td>game</td>
<td>shikaku</td>
<td>english</td>
<td>real estate</td>
</tr>

EOM;

for ($i=1; $i<$maxid+1 ; $i++) {
$sql = "select * from user where userID=".$i;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$username=$row['username'];


$sql = "select * from servicelist where username=\"".$username."\"";
$result = mysql_query($sql);
if ($result){
$row = mysql_fetch_assoc($result);
$serviceid=$row['serviceid'];
} else {
$serviceid=0;
}

if($serviceid >= 100000){
$serviceid=$serviceid-100000;
}
if($serviceid >= 10000){
$chk1="checked";
$serviceid=$serviceid-10000;
}else{
$chk1="";
}
if($serviceid >= 1000){
$chk2="checked";
$serviceid=$serviceid-1000;
}else{
$chk2="";
}
if($serviceid >= 100){
$chk3="checked";
$serviceid=$serviceid-100;
}else{
$chk3="";
}
if($serviceid >= 10){
$chk4="checked";
$serviceid=$serviceid-10;
}else{
$chk4="";
}
if($serviceid >= 1){
$chk5="checked";
$serviceid=$serviceid-1;
}else{
$chk5="";
}

print "<tr><td class=\"name\">";
print $username;
print <<< EOM
</td>
<td><input type="checkbox" id="chk
EOM;
$num=$i*5-4;
print $num;
print <<< EOM
" class="big"
EOM;
print $chk1;
print <<< EOM
></td>

EOM;

print <<< EOM
<td><input type="checkbox" id="chk
EOM;
$num=$i*5-3;
print $num;
print <<< EOM
" class="big"
EOM;
print $chk2;
print <<< EOM
></td>

EOM;

print <<< EOM
<td><input type="checkbox" id="chk
EOM;
$num=$i*5-2;
print $num;
print <<< EOM
" class="big"
EOM;
print $chk3;
print <<< EOM
></td>

EOM;

print <<< EOM
<td><input type="checkbox" id="chk
EOM;
$num=$i*5-1;
print $num;
print <<< EOM
" class="big"
EOM;
print $chk4;
print <<< EOM
></td>

EOM;

print <<< EOM
<td><input type="checkbox" id="chk
EOM;
$num=$i*5;
print $num;
print <<< EOM
" class="big"
EOM;
print $chk5;
print <<< EOM
></td>
</tr>

EOM;
}

print "</table>";
print <<< EOM
<input type="button" id="signup" value="commit" onClick="control()">
</form>
 <p><input type="button" id="portal" value="portal" onClick="location.href='../portal.php'" style="width:100%;font-size:50px"></p>

EOM;

print <<< EOM
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

function control () {
   if (window.confirm('Are you sure?')){

EOM;

for ($i=1;$i<$maxid+1;$i++) {

$num=$i*5-4;
print <<< EOM
   if(document.forms.servicetable.chk
EOM;
print $num;
print <<< EOM
.checked){

EOM;
print <<< EOM
        var dat
EOM;
print $num;
print <<< EOM
=1;
   } else {
        var dat
EOM;
print $num;
print <<< EOM
=0;
   }

EOM;

$num=$i*5-3;
print <<< EOM
   if(document.forms.servicetable.chk
EOM;
print $num;
print <<< EOM
.checked){

EOM;
print <<< EOM
        var dat
EOM;
print $num;
print <<< EOM
=1;
   } else {
        var dat
EOM;
print $num;
print <<< EOM
=0;
   }

EOM;

$num=$i*5-2;
print <<< EOM
   if(document.forms.servicetable.chk
EOM;
print $num;
print <<< EOM
.checked){

EOM;
print <<< EOM
        var dat
EOM;
print $num;
print <<< EOM
=1;
   } else {
        var dat
EOM;
print $num;
print <<< EOM
=0;
   }

EOM;

$num=$i*5-1;
print <<< EOM
   if(document.forms.servicetable.chk
EOM;
print $num;
print <<< EOM
.checked){

EOM;
print <<< EOM
        var dat
EOM;
print $num;
print <<< EOM
=1;
   } else {
        var dat
EOM;
print $num;
print <<< EOM
=0;
   }

EOM;

$num=$i*5;
print <<< EOM
   if(document.forms.servicetable.chk
EOM;
print $num;
print <<< EOM
.checked){

EOM;
print <<< EOM
        var dat
EOM;
print $num;
print <<< EOM
=1;
   } else {
        var dat
EOM;
print $num;
print <<< EOM
=0;
   }

EOM;
}

print <<< EOM
        var maxid=
EOM;
$num=$maxid*5;
print $num;
print <<< EOM
;

EOM;

print <<< EOM
        $.ajax({
              url: 'control.php',
              type: 'post',
              dataType: 'json',
              data: {

EOM;

for ($num=1;$num<$maxid*5+1;$num++) {
print <<< EOM
                      dat
EOM;
print $num;
print <<< EOM
: dat
EOM;
print $num;
print <<< EOM
,

EOM;
}

print "                      maxid: maxid";

print <<< EOM

              }
          })
          .done(function (response) {
              alert(response.data);
           })
        .fail(function (response) {
              alert(response.data);
            });
         }
  }
</script>

EOM;
mysql_close($con);

?>

</body>
</html>
