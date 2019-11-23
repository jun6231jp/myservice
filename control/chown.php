<?php
session_start();
$path=$_SESSION['path'];
$_SESSION['path']=$_SESSION['oldpath'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title>chown</title>

<style>
input {
  width:100%;
  height:70px;
  font-size:50px;
 }
</style>
</head>

<body>
<input id='own'>
<input type='button' value='chown' onClick="chown()">
<input type='button' value='back' onClick='location.href="edit.php"'>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

function chown () {
<?php
print "var path='".$path."';";
?>
  var own=document.getElementById('own').value;
      document.getElementById('own').value="";
        $.ajax({
              url: 'do_chown.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path,
                own: own
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
