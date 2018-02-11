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
if ($serviceid < 100){
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
        <h1>Registration</h1>
        <p><table style="font-size:40px; width:100%">
            <tr>
		<td width="30%">word</td>
		<td width="70%"> 
		    <input type="text" id="word" style="width:96%;font-size:28px;font-family:monospace;"></td>
	    </tr>
            <tr>
		<td>explanation</td>
		<td>
		    <textarea id="ex" cols="48" rows="10" style="font-size:28px;font-family:monospace;width:96%"></textarea></td>
            </tr>
        </table></p>
        <form id="fileform"  method="post" enctype="multipart/form-data"> 
            <p><input type="file" name="upfile" style="font-size:20px; width:100%; height:80px"/></p>
            <p><input type="button" id="execute" value="submit" style="width:100%;font-size:50px"></p>
        </form>
        <p><input type="button" id="show" value="show table" onClick="location.href='wordlist_show.php'" style="width:100%;font-size:50px"></p>
        <p><input type="button" id="revise" value="revise table" onClick="location.href='register_revise.php'" style="width:100%;font-size:50px"></p>
        <p><input type="button" id="portal" value="portal" onClick="location.href='../portal.php'" style="width:100%;font-size:50px"></p>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>

	 $(function () {

	     $('#execute').click(function () {
		 if (window.confirm('Are you sure?')){
		     var word= $('#word').val();
		     var ex=$('#ex').val();
		     document.getElementById("word").value="";
		     document.getElementById("ex").value="";
		     $.ajax({
			 url: 'wordlist.php',
			 type: 'post',
			 dataType: 'json', 
			 data: { 
			     word: word,
			     ex: ex
			 }
		     })
		      .done(function (response) {
			  alert('success');
			  var formdata = new FormData($('#fileform').get(0));
			  $.ajax({
			      url  : 'upload.php',
			      type : 'post',
			      cache       : false,
			      contentType : false,
			      processData : false,
			      data : formdata,
			      dataType    : 'html'
			  })
			   .done(function(data, textStatus, jqXHR){
			       alert(data);
			   })
			   .fail(function(jqXHR, textStatus, errorThrown){
			       alert("fail");
			   });
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
