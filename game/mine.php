<html>

<style>
  table {
       border: 0px;
       border-style: solid;
       border-color: black;
       border-collapse: collapse;
  }
  td {
       border: 1px;
       border-style: solid;
       border-color: black;
       border-collapse: collapse;
<?php
       session_start();
       $size=85/$_SESSION['X'];
       print "width:".$size."vmin;";
       print "height:".$size."vmin;";
?>
  }
  input.mines {
<?php
       print "width:".$size."vmin;";
       print "height:".$size."vmin;";
?>
  }
 input.sel {
    width:5%;
    height:5%;
 }
 input {
    font-size:40px;
 }
 span {
    font-size:40px;
 }
</style>


<body>
<p>
<span>OPEN</span>
&nbsp;
<input type='radio' class='sel' name='mine' id='open' checked='checked'>
&nbsp;&nbsp;
<span>FLAG</span>
&nbsp;&nbsp;
<input type='radio' class='sel' name='mine' id='flag'>
&nbsp;&nbsp;
<?php
session_start();
print "<input style='width:150px' readonly='readonly' id='remain' value='".$_SESSION['bombs']."'";
?>>
&nbsp;&nbsp;
<input type="submit" value="reset" onClick="location.href='mineset.php'">
&nbsp;&nbsp;
<input type="submit" value="back" onClick="location.href='index.php'">

</p>
<p>
<table>
<?php
for ($j=0;$j<$_SESSION['Y'];$j++){
print "<tr>\n";
for ($i=0;$i<$_SESSION['X'];$i++){
print "<td><input type='image' class='mines' src='./mine/cell.png' value='";
print substr($_SESSION['mine'],$_SESSION['X']*$j+$i,1);
print "' id='".($_SESSION['X']*$j+$i)."' onClick='bopen(".($_SESSION['X']*$j+$i).")'></td>\n";
}
print "</tr>\n";
}
?>

</table>
</p>

<p>
<input id="hour" value="0" style='width:20%'>
<span>:</span>
<input id="min" value="0" style='width:20%'>
<span>:</span>
<input id="sec" value="0" style='width:20%'>
</p>
<script type="text/javascript">
<?php
print "var X =".$_SESSION['X'].";";
print "var Y =".$_SESSION['Y'].";";
?>
var flag=0;
var flag2=0;
var flag3 = 0;

 function start() {
   if (flag3 == 0){
      if(parseInt(document.getElementById('sec').value)==59){
document.getElementById('sec').value="0";
        if(parseInt(document.getElementById('min').value)==59){
       document.getElementById('min').value="0";
           $("#hour").val(parseInt($("#hour").val())+1);
        }
        else {
document.getElementById('min').value=parseInt(document.getElementById('min').value)+1;
        }
      }
      else {
document.getElementById('sec').value=parseInt(document.getElementById('sec').value)+1;
      }
    }
 }

function chk(){
if (parseInt(document.getElementById('remain').value)==0 && flag2==0){
var chk=0;

for (var j=0;j<Y;j++){
for (var i=0;i<X;i++){
if (parseInt(document.getElementById(X*j+i).value)===9 || (parseInt(document.getElementById(X*j+i).value) < 9 && !document.getElementById(X*j+i).disabled)){
chk = 1;
stop();
break;
}
}
}
if (chk==0){
 stop();
 alert('clear');
flag2=1;
}
}
}

function startfunc(){
 setInterval("chk()",1000);
 setInterval("start()",1000);
}


function bopen(bid) {
if (flag==0){
startfunc();
flag=1;
}

 var bombs=parseInt(document.getElementById('remain').value);
 if (document.getElementById('open').checked){
if(parseInt(document.getElementById(bid).value) < 9){
  document.getElementById(bid).innerHTML=document.getElementById(bid).disabled;   document.getElementById(bid).disabled=true;
}
else if (parseInt(document.getElementById(bid).value)==9) {
document.getElementById(bid).src='./mine/bomb.png';
stop();
alert('Game Over');
  }
  if (document.getElementById(bid).value=='0') {
document.getElementById(bid).src='./mine/num_0.png';
document.getElementById(bid).value=-1;

if (bid==0){
bopen(bid+1);
bopen(bid+X);
bopen(bid+X+1);
}
else if (bid==X-1){
bopen(bid-1);
bopen(bid+X);
bopen(bid+X-1);
}
else if (bid==X*(Y-1)){
bopen(bid-X);
bopen(bid-X+1);
bopen(bid+1);
}
else if (bid==X*Y-1){
bopen(bid-X);
bopen(bid-X-1);
bopen(bid-1);
}
else if (bid % X==0){
bopen(bid-X);
bopen(bid-X+1);
bopen(bid+1);
bopen(bid+X);
bopen(bid+X+1);
}
else if (bid % X==X-1) {
bopen(bid-X);
bopen(bid-X-1);
bopen(bid-1);
bopen(bid+X);
bopen(bid+X-1);
}
else if (bid < X){
bopen(bid-1);
bopen(bid+1);
bopen(bid+X);
bopen(bid+X-1);
bopen(bid+X+1);
}
else if (bid > X*(Y-1)){
bopen(bid-X);
bopen(bid-X-1);
bopen(bid-X+1);
bopen(bid-1);
bopen(bid+1);
}
else {
bopen(bid-X);
bopen(bid-X-1);
bopen(bid-X+1);
bopen(bid-1);
bopen(bid+1);
bopen(bid+X);
bopen(bid+X-1);
bopen(bid+X+1);
}
}
  else if (document.getElementById(bid).value=='1') {document.getElementById(bid).src='./mine/num_1.png'}
  else if (document.getElementById(bid).value=='2') {document.getElementById(bid).src='./mine/num_2.png'}
  else if (document.getElementById(bid).value=='3') {document.getElementById(bid).src='./mine/num_3.png'}
  else if (document.getElementById(bid).value=='4') {document.getElementById(bid).src='./mine/num_4.png'}
  else if (document.getElementById(bid).value=='5') {document.getElementById(bid).src='./mine/num_5.png'}
  else if (document.getElementById(bid).value=='6') {document.getElementById(bid).src='./mine/num_6.png'}
  else if (document.getElementById(bid).value=='7') {document.getElementById(bid).src='./mine/num_7.png'}
  else if (document.getElementById(bid).value=='8') {document.getElementById(bid).src='./mine/num_8.png'}

 }

 if (document.getElementById('flag').checked){
  if (parseInt(document.getElementById(bid).value) > 9) {
   document.getElementById(bid).src='./mine/cell.png';
   document.getElementById(bid).value=parseInt(document.getElementById(bid).value)-10;
bombs=bombs + 1;
document.getElementById('remain').value=bombs;
  }
  else{
   document.getElementById(bid).value=parseInt(document.getElementById(bid).value)+10;
   document.getElementById(bid).src='./mine/flag.png';
bombs=bombs - 1;
document.getElementById('remain').value=bombs;
}
}
}

 function stop(){
  if (flag3 == 0) {
   flag3=1;
  }
 }
</script>
</body>
</html>
