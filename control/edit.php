<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title>file control</title>

<style>
input {
  width:100%;
  height:70px;
  font-size:50px;
 }
.mod {
  font-size:30px;
}
.owner {
 font-size:30px;
}
.group {
  font-size:30px;
}
.editable {
 font-size:50px;
 color:green;
}
.readonly {
 font-size:50px;
}
.dir {
 font-size:50px;
 color:blue;
}
table {
   width: 100%;
}
td {
text-align:center;
margin-right:auto;
margin-left:auto;
}
</style>
</head>

<body>
<table>
<?php
session_start();
$_SESSION['oldpath'] = "";
if ($_SESSION['path'] == "") {
$pwd='/var/www/html';
}
else {
$pwd=$_SESSION['path'];
}

$line=exec('sudo ls -al '.$pwd.' | wc -l');
for ($i=2;$i<=$line;$i++){

$mod=exec('sudo ls -al '.$pwd.' | sed -e "s/ \+/ /g" | cut -d " " -f 1 | head -'.$i.' | tail -1');

if (substr($mod,0,1) == "d") {
 $type="dir";
}
elseif (substr($mod,2,1) == "w") {
 $type="editable";
}
else {
 $type="readonly";
}

$str=exec('sudo ls -al '.$pwd.' | sed -e "s/ \+/ /g" | head -'.$i.' | tail -1');
$list=explode(" ",$str);
$owner=$list[2];
$group=$list[3];
$item=$list[8];

print "<tr>
";
print "<td><input type='button' class='mod' value='".$mod."' onClick=\"chmod('".$pwd."/".$item."')\"></td>
";
print "<td><input type='button' class='owner' value='".$owner."'onClick=\"chown('".$pwd."/".$item."')\"></td>
";
print "<td><input type='button' class='group' value='".$group."' onClick=\"chgrp('".$pwd."/".$item."')\"></td>
";
if ($type == "dir") {
 print "<td><input type=button class='".$type."' value='".$item."' onClick=\"chdir('".$pwd."/".$item."')\"></td>
";
}
elseif ($type == "editable") {
 print "<td><input type=button class='".$type."' value='".$item."' onClick=\"edit('".$pwd."/".$item."')\"></td>
";
}
elseif ($type == "readonly") {
 print "<td><input type=button class='".$type."' value='".$item."' onClick=\"read('".$pwd."/".$item."')\"></td>
";
}

print "</tr>
";
}
?>

</table>
<p>
<input id='path' style='width:60%'><input type='button' value='cd' onClick='cd()' style='width:30%'>
</p>
<p>
<input value='back' type='button' onClick='location.href="../portal.php"'>
</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
function cd () {
        var path=document.getElementById('path').value;
        $.ajax({
              url: 'chpath.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path
              }
          })
          .done(function (response) {
             location.href='edit.php';
           })
          .fail(function (response) {
              alert(response.data);
           });
}

function chmod (path) {
        $.ajax({
              url: 'chpath.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path
              }
          })
          .done(function (response) {
             location.href='chmod.php';
           })
          .fail(function (response) {
              alert(response.data);
           });
}

function chown (path) {
        $.ajax({
              url: 'chpath.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path
              }
          })
          .done(function (response) {
             location.href='chown.php';
           })
          .fail(function (response) {
              alert(response.data);
           });
}

function chgrp (path) {
        $.ajax({
              url: 'chpath.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path
              }
          })
          .done(function (response) {
             location.href='chgrp.php';
           })
          .fail(function (response) {
              alert(response.data);
           });
}

function chdir (path) {
        $.ajax({
              url: 'chpath.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path
              }
          })
          .done(function (response) {
             location.href='edit.php';
           })
          .fail(function (response) {
              alert(response.data);
           });
}

function edit (path) {
        $.ajax({
              url: 'chpath.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path
              }
          })
          .done(function (response) {
             location.href='vim.php';
           })
          .fail(function (response) {
              alert(response.data);
           });
}

function read (path) {
         $.ajax({
              url: 'chpath.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path
              }
          })
          .done(function (response) {
             location.href='cat.php';
           })
          .fail(function (response) {
              alert(response.data);
           });
}
</script>

</body>
</html>

