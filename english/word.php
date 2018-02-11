<?php
session_start();
if (!$_SESSION['name']){
    exit;
}
$serviceid=$_SESSION['serviceid'];
if ($serviceid > 100000){
    $serviceid=$serviceid-100000;
}
if ($serviceid > 10000){
    $serviceid=$serviceid-10000;
}
if ($serviceid > 1000){
    $serviceid=$serviceid-1000;
}
if ($serviceid > 100){
    $serviceid=$serviceid-100;
}
if ($serviceid < 10){
    exit;
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>word list</title>
    </head>
    <body>
	<p>
            <input type="text" id="word" placeholder="Word" style="width:80%;height:50px;font-size:50px;font-family:monospace;position:center">
	</p>
	<p>
            <input type="text" id="memo" placeholder="Memo" style="width:80%;height:50px;font-size:50px;font-family:monospace;position:center">
	</p>

	<p>
            <input type="button" id="execute" value="submit" style="font-size:50px;position:center">
	</p>


	<p>
	    <input type="button" id="show" value="show table" onClick="location.href='wordlist_show.php'" style="font-size:50px;position:center">
	</p>


	<p>
	    <input type="button" id="showall" value="show all table" onClick="location.href='wordlist_allshow.php'" style="font-size:50px;position:center">
	</p>


	<p>
            <input type="button" id="portal" value="back" onClick="location.href='./'" style="font-size:50px;position:center">
	</p>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>

	 $(function () {
	     $('#execute').click(function () {
		 if (window.confirm('Are you sure?')){
		     var word= $('#word').val();
		     var memo=$('#memo').val();
		     document.getElementById("word").value="";
		     document.getElementById("memo").value="";
		     $.ajax({
			 url: 'wordlist.php',
			 type: 'post',
			 dataType: 'json', 
			 data: { 
			     word: word,
			     memo: memo
			 }
		     })
		      .done(function (response) {
			  alert(response.data);
		      })
		      .fail(function () {
			  alert('failed');
		      });
		 }
	     });
	 });
	</script>
    </body>
</html>
