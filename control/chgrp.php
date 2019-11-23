<?php
session_start();
$path=$_SESSION['path'];
$_SESSION['path']=$_SESSION['oldpath'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title>chgrp</title>

<style>
input {
  width:100%;
  height:70px;
  font-size:50px;
 }
</style>
</head>

<body>
<input id='grp'>
<input type='button' value='chgrp' onClick="chgrp()">
<input type='button' value='back' onClick='location.href="edit.php"'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

function chgrp () {
<?php
print "var path='".$path."';";
?>
  var grp=document.getElementById('grp').value;
      document.getElementById('grp').value="";
        $.ajax({
              url: 'do_chgrp.php',
              type: 'post',
              dataType: 'json',
              data: {
                path: path,
                grp: grp
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
