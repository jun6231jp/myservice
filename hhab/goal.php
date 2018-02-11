<?php
session_start();
if (!$_SESSION['name']){
    exit;
}

$serviceid=$_SESSION['serviceid'];
if ($serviceid > 100000){
    $serviceid=$serviceid-100000;
}
if ($serviceid < 10000){
    exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>House Hold Account Book</title>

        <style>
         input {
             height: 120px;
             font-size:60px;
         }
	 
         form {
             width:90% ;
             height: 60px;
         }
         select {
             width: 100% ;
             height: 60px;
             font-size:40px ;
         }
        </style>

    </head>
    <body>
	<form id="hhabform" action="">
            <p><span style="width:10%;font-size:60px">月</span><input type="text" id="money" style="width:70%;font-family:monospace;"><span style="width:10%;font-size:60px">円</span></p><br>

            <p><input type="button" id="execute" value="登録" style="width:110%;font-size:60px">
            </p>
            <p><input type="button" id="portal" value="戻る" onClick="location.href='index.php'" style="width:110%;font-size:50px"></p>
	</form>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
	 $(function () {

	     $('#execute').click(function () {
		 if(document.getElementById("money").value == ""){
		     window.confirm('err');
		 } else {
		     if (isNaN(document.getElementById("money").value)){
			 window.confirm('err');
		     } else {
			 if (window.confirm('Are you sure?')){
			     <?php
			     session_start();
			     print "var name= \"".$_SESSION['name']."\";";
			     ?>

			     var money=document.getElementById("money").value;
			     document.getElementById("money").value="";

			     $.ajax({
				 url: 'goal_set.php',
				 type: 'post',
				 dataType: 'json', 
				 data: {
				     name: name, 
				     money: money,
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
		 }
	     });
	 });
	</script>
    </body>
</html>
