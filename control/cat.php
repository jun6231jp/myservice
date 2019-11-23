<?php
session_start();
$path=$_SESSION['path'];
$_SESSION['path']=$_SESSION['oldpath'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title>vim</title>

<style>
input {
  width:100%;
  height:70px;
  font-size:50px;
 }
textarea {
  width:100%;
  height:500px;
}
</style>
</head>

<body>

<textarea id="contents">
<?php
$line=exec('sudo cat '.$path.' | wc -l');
for ($i=1;$i<=$line;$i++){
$str=exec ('sudo cat '.$path.' | head -'.$i.' | tail -1');
print htmlspecialchars($str)."\n";
}
?>
</textarea>

<input type='button' value='back' onClick='location.href="edit.php"'>

</body>
</html>
