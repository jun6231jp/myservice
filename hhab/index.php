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
	 .checkbox {
	     width: 100px;
	     height: 100px;
	     box-sizing: border-box;
	     -webkit-transition: background-color 0.2s linear;
	     transition: background-color 0.2s linear;
	     
	     position: center;
	     display: inline-block;

	     margin: 0 0 8px 0;
	     padding: 12px 12px 12px 12px;

	     border-radius: 8px;
	     background-color: #f6f7f8;
	     vertical-align: middle;
	     cursor: pointer;
	 }
	 .checkbox:hover {
	     background-color: #e2edd7;
	 }
	 .checkbox:hover:after {
	     border-color: #53b300;
	 }
	 .checkbox:before {
	     -webkit-transition: opacity 0.2s linear;
	     transition: opacity 0.2s linear;
	     position: center;
	     top: 50%;
	     left: 0px;
	     display: block;
	     margin-top: -7px;
	     width: 5px;
	     height: 9px;
	     border-right: 3px solid #53b300;
	     border-bottom: 3px solid #53b300;
	     content: '';
	     opacity: 0;
	     -webkit-transform: rotate(45deg);
	     -ms-transform: rotate(45deg);
	     transform: rotate(45deg);
	 }
	 input[type=checkbox]:checked + .checkbox:before {
	     opacity: 1;
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
            <table style="width:100%;">
		<tr>
		    <input type="text" id="money" style="width:72%;font-family:monospace;"><span style="width:28%;font-size:60px">円</span>
		</tr>
		<tr>
		    <td width="90%">
			<input type="text" id="item" list="list" style="width:82%;font-family:monospace;">

			<?php

			$con = mysql_connect('localhost','account','password'); 
			$db = mysql_select_db('hhab',$con);
			session_start();
			$name=$_SESSION['name'];
			//sql
			$sql="select count(distinct item) from useruse where userID=\"".$name."\"";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
			$line=$row['count(distinct item)'];
			if ($line > 0){
			    print "<datalist id=\"list\">";    
			    for ($i=0;$i<$line;$i++){
				//sql
				$sql="select distinct item from useruse where userID=\"".$name."\" order by time limit 1 offset ".$i;
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				$item=$row['item'];

				print "<option value=\"".$item."\">";
			    }
			    print "</datalist>";
			}

			mysql_close($con);
			?>

		    </td>

		    <td width="10%">
			<input type="checkbox" id="budget" class="checkbox" width="100%">
		    </td>

		</tr>
            </table><br>
            <p><input type="button" id="execute" value="登録" style="width:110%;font-size:60px">
            </p>

            <p><input type="button" id="show" value="一覧" onClick="location.href='show_table.php'" style="width:110%;font-size:60px">
            </p>

            <p><input type="button" id="goal" value="目標設定" onClick="location.href='goal.php'" style="width:110%;font-size:60px">
            </p>

            <p><input type="button" id="portal" value="戻る" onClick="location.href='../portal.php'" style="width:110%;font-size:50px"></p>
	</form>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
	 $(function () {

	     $('#execute').click(function () {
		 if(document.getElementById("money").value == "" || document.getElementById("item").value == ""){
		     window.confirm('err');
		 } else {
		     if (isNaN(document.getElementById("money").value)){
			 window.confirm('err');
		     } else {
			 if (window.confirm('Are you sure?')){
			     <?php
			     print "var name= \"".$_SESSION['name']."\";";
			     ?>

			     var money=document.getElementById("money").value;
			     var item=document.getElementById("item").value;
			     document.getElementById("item").value="";
			     document.getElementById("money").value="";

			     var budget = 0;
			     if (document.forms.hhabform.budget.checked) {
				 budget = 1;
			     }
			     $.ajax({
				 url: 'hhablist.php',
				 type: 'post',
				 dataType: 'json', 
				 data: {
				     name: name, 
				     money: money,
				     item: item,
				     budget: budget
				 }
			     })
			      .done(function (response) {
				  alert(response.data);
				  location.href='index.php';
			      })
			      .fail(function (response) {
				  alert(response.data);
				  location.href='index.php';
			      });
			 }
		     }
		 }
	     });
	 });
	</script>
    </body>
</html>
