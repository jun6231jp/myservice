<!DOCTYPE html>
<?php
session_start();

$con = mysql_connect('localhost','password','account');
$db = mysql_select_db('shogi',$con);
$sql = "update heya set sente='' where sente='".$_SESSION['name']."'";
$result = mysql_query($sql);
$sql = "update heya set gote='' where gote='".$_SESSION['name']."'";
$result = mysql_query($sql);
mysql_close($con);
?>

<html>
    <head>
        <title>Shogi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
	 input {
	     border: 1px;
	     border-style: solid;
	     width:80%;
	     height: 40px; 
	     font-size:15px;
	 }
	 .sw {
	     font-size:20px;
	     width: 100%;
	     height: 60px;
	 }

	 table {
	     width:100%;
	 }
	 tr {
	     width:100%;
	 }
	 td {
	     width:20%;
	 }
	</style>
    </head>
    <body>
        <div>
            <table>
                <tr>
                    <td>
                        <span>部屋1</span>
                    </td>
                    <td>
                        <input type="button" value="先手" id="S1" onClick="reg(1)">
                    </td>
                    <td>
                        <input type="button" value="後手" id="G1" onClick="reg(2)">
                    </td>
                    <td>
                        <input type="button" value="観戦" id="K1" onClick="visit(1)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>部屋2</span>
                    </td>
                    <td>
                        <input type="button" value="先手" id="S2" onClick="reg(3)">
                    </td>
                    <td>
                        <input type="button" value="後手" id="G2" onClick="reg(4)">
                    </td>
                    <td>
                        <input type="button" value="観戦" id="K2" onClick="visit(2)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>部屋3</span>
                    </td>
                    <td>
                        <input type="button" value="先手" id="S3" onClick="reg(5)">
                    </td>
                    <td>
                        <input type="button" value="後手" id="G3" onClick="reg(6)">
                    </td>
                    <td>
                        <input type="button" value="観戦" id="K3" onClick="visit(3)">
                    </td>
                </tr>
            </table>
        </div>
	<div>
	    <p>
		<input type="submit" class="sw" id="portal" value="戻る" onClick="location.href='../portal.php'"></input>
	    </p>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
         function reg(num){
	     <?php
	     print "var name='".$_SESSION['name']."';\n";
	     ?>
	     var heya = 0;
	     if (num == 1 || num == 2)
		 {
		     heya = 1;
		 }
	     else if (num == 3 || num == 4)
		 {
		     heya = 2;
		 }
	     else if (num == 5 || num == 6)
		 {
		     heya = 3;
		 }
             if (name != "")
		 {
                     $.ajax({
			 url: 'reg.php',
			 type: 'post',
			 dataType: 'json',
			 data: {
                             name: name,
                             num : num,
                             heya: heya
			 }
                     })
                      .done(function (response) {
			  location.href="ban.php";
                      });
		 }
         }
         function visit(heya) {

             $.ajax({
                 url: 'visit.php',
                 type: 'post',
                 datatype: 'json',
                 data: {
                     heya: heya
                 }
             })
              .done(function (response) {
                  location.href="ban.php";
              });
         }         

         function update(){
             $.ajax({
                 url: 'update_heya.php',
                 type: 'post',
                 datatype: 'json',
                 data: {
                 }
             })
              .done(function (response){
                  if (response.data[0] != '' && response.data[0] != null)
                      {
                          document.getElementById("S1").type="text";
                          $('#S1').attr('readonly',true);
                          document.getElementById("S1").value=response.data[0];
                          document.getElementById("S1").onclick="";
                      }
                  else if (response.data[0] == '' || response.data[0] == null)
                      {
                          document.getElementById("S1").type="button";
                          document.getElementById("S1").value="先手";
                          document.getElementById("S1").onclick= new Function("reg(1);");
                      }
                  if (response.data[1] != '' && response.data[1] != null)
                      {
                          document.getElementById("G1").type="text";
                          $('#G1').attr('readonly',true);
                          document.getElementById("G1").value=response.data[1];
                          document.getElementById("G1").onclick="";
                      }
                  else if (response.data[1] == '' || response.data[1] == null)
                      {
                          document.getElementById("G1").type="button";
                          document.getElementById("G1").value="後手";
                          document.getElementById("G1").onclick= new Function("reg(2);");
                      }
                  if (response.data[2] != '' && response.data[2] != null)
                      {
                          document.getElementById("S2").type="text";
                          $('#S2').attr('readonly',true);
                          document.getElementById("S2").value=response.data[2];
                          document.getElementById("S2").onclick="";
                      }
                  else if (response.data[2] == '' || response.data[2] == null)
                      {
                          document.getElementById("S2").type="button";
                          document.getElementById("S2").value="先手";
                          document.getElementById("S2").onclick= new Function("reg(3);");
                      }
                  if (response.data[3] != '' && response.data[3] != null)
                      {
                          document.getElementById("G2").type="text";
                          $('#G2').attr('readonly',true);
                          document.getElementById("G2").value=response.data[3];
                          document.getElementById("G2").onclick="";
                      }
                  else if (response.data[3] == '' || response.data[3] == null)
                      {
                          document.getElementById("G2").type="button";
                          document.getElementById("G2").value="後手";
                          document.getElementById("G2").onclick= new Function("reg(4);");
                      }
                  if (response.data[4] != '' && response.data[4] != null)
                      {
                          document.getElementById("S3").type="text";
                          $('#S3').attr('readonly',true);
                          document.getElementById("S3").value=response.data[4];
                          document.getElementById("S3").onclick="";
                      }
                  else if (response.data[4] == '' || response.data[4] == null)
                      {
                          document.getElementById("S3").type="button";
                          document.getElementById("S3").value="先手";
                          document.getElementById("S3").onclick= new Function("reg(5);");
                      }
                  if (response.data[5] != '' && response.data[5] != null)
                      {
                          document.getElementById("G3").type="text";
                          $('#G3').attr('readonly',true);
                          document.getElementById("G3").value=response.data[5];
                          document.getElementById("G3").onclick="";
                      }
                  else if (response.data[5] == '' || response.data[5] == null)
                      {
                          document.getElementById("G3").type="button";
                          document.getElementById("G3").value="後手";
                          document.getElementById("G3").onclick= new Function("reg(6);");
                      }

              });
         }
         window.onload=function startfnc() {
             update();
             setInterval("update()",3000);
         }
        </script>
    </body>
</html>
