<?php
session_start();
$_SESSION['name']="";
$_SESSION['serviceid']=0;
?>

<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<title>user login</title>
    </head>
    <h1>LOGIN<h1>
	<style>
	 input {
	     max-width:100%;
	     font-size:40px;
	 }
	 #sec {
	     position: fixed;
	     width: 100%;
	     height: 120px;
	 }
	</style>
	<body>
	    <p>
		<input id="username" placeholder="user name">
	    </p>
	    <p>
		<input id="password" type="password" placeholder="password">
	    </p>
	    <p>
		<input type="submit" id="login" value="login">
	    </p>
	    <p>
		<input type="submit" id="signup" value="Sign Up">
	    </p>

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	    <script type="text/javascript">

	     $(function () {
		 $('#signup').click(function () {
		     location.href="signup.php";
		 });   
		 $('#login').click(function () {
		     var name=document.getElementById("username").value;
		     var pass=document.getElementById("password").value;

		     $.ajax({
			 url: 'auth.php',
			 type: 'post',
			 dataType: 'json', 
			 data: {
			     name:name,
			     pass:pass
			 }
		     })
		      .done(function (response) {
			  alert(response.data);
			  location.href="portal.php";	    
		      })
		      .fail(function () {
			  alert('err');	    
		      });
		 });
	     });        
	    </script>


	</body>
</html>

