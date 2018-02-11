<?php
session_start();
if (!$_SESSION['name']){
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
        <h1>shikaku Revise</h1>
        <p><table style="font-size:40px; width:100%">
            <tr>
		<td width="30%">ID</td>
		<td width="70%">
		    <input type="text" id="id" style="width:96%;font-size:28px;font-family:monospace;"></td>
            </tr>
            <tr>
		<td width="30%">word</td>
		<td width="70%"> 
		    <input type="text" id="word" style="width:96%;font-size:28px;font-family:monospace;"></td>
	    </tr>
            <tr>
		<td>explanation</td>
		<td>
		    <textarea id="ex" cols="50" rows="10" style="font-size:28px;font-family:monospace;width:100%"></textarea></td>
            </tr>
        </table></p>
        <form id="fileform"  method="post" enctype="multipart/form-data"> 
            <p><input type="file" name="upfile" style="font-size:20px; width:100%; height:80px"/></p>
            <p><input type="button" id="execute" value="submit" style="width:100%;font-size:50px"></p>
        </form>
        <p><input type="button" id="show" value="show table" onClick="location.href='wordlist_show.php'" style="width:100%;font-size:50px"></p>
        <p><input type="button" id="register" value="back" onClick="location.href='index.php'" style="width:100%;font-size:50px"></p>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>

	 $(function () {

	     $('#execute').click(function () {
		 if (window.confirm('Are you sure?')){
		     var id=$('#id').val();
		     var word= $('#word').val();
		     var ex=$('#ex').val();
		     document.getElementById("word").value="";
		     document.getElementById("ex").value="";
		     $.ajax({
			 url: 'wordlist_revise.php',
			 type: 'post',
			 dataType: 'json', 
			 data: { 
			     id: id,
			     word: word,
			     ex: ex
			 }
		     })
		      .done(function (response) {
			  alert('success');
			  var formdata = new FormData($('#fileform').get(0));
			  $.ajax({
			      url  : 'upload_revise.php',
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
