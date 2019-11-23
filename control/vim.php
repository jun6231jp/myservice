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
  height:700px;
}
</style>
</head>

<body>

<textarea id="contents">
<?php
$line=exec('sudo cat '.$path.' | wc -l');
for ($i=1;$i<=$line;$i++){
$str=exec ('sudo cat '.$path.' | head -'.$i.' | tail -1');
print htmlspecialchars($str)."
";
}
?>
</textarea>


<input type='button' value='save' onClick="updatefile()">
<input type='button' value='back' onClick='location.href="edit.php"'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

function updatefile () {
<?php
print "var path= '".$path."';
"
?>
 var text = document.getElementById('contents').value;
        $.ajax({
              url: 'save.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path,
                text: text
              }
          })
          .done(function (response) {
             alert('saved');
           })
          .fail(function (response) {
             alert(response.data);
           });
}

</script>

</body>
</html>
