<?php
session_start();
$path=$_SESSION['path'];
$_SESSION['path']=$_SESSION['oldpath'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title>chmod</title>

<style>
input {
  width:100%;
  height:70px;
  font-size:50px;
 }
</style>
</head>

<body>
<input id='mod'>
<input type='button' value='chmod' onClick="chmod()">
<input type='button' value='back' onClick='location.href="edit.php"'>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

function chmod () {
<?php
print "var path='".$path."';";
?>
  var mod=document.getElementById('mod').value;
      document.getElementById('mod').value="";
        $.ajax({
              url: 'do_chmod.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path,
                mod: mod
              }
          })
          .done(function (response) {
             alert(response.data);
           })
          .fail(function (response) {
              alert(response.data);
           });
}
</script>

</body>
</html>
