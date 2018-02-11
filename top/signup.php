<html>
    <title>user add</title>
    <h1>Sign Up<h1>
	<style>
	 input {
	     max-width:80%;
	     font-size:40px;
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
		<input type="submit" id="login" value="Join">
	    </p>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	    <script type="text/javascript">

	     $(function () {
		 $('#login').click(function () {
		     var name=document.getElementById("username").value;
		     var pass=document.getElementById("password").value;

		     $.ajax({
			 url: 'user_add.php',
			 type: 'post',
			 dataType: 'json', 
			 data: {
			     name:name,
			     pass:pass
			 }
		     })
		      .done(function (response) {
			  alert(response.data);
			  location.href="index.php";	    
		      })
		      .fail(function () {
			  alert('err');	    
		      });
		 });
	     });        
	    </script>


	</body>
</html>
