<!DOCTYPE html>

<html>
    <head>
        <title>Kifu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <style>
         table.ban {
             border: 0px;
             border-style: solid;
             border-color: black;
             border-collapse: collapse;
         }
         td.ban {
             border: 1px;
             border-style: solid;
             border-color: black;
             border-collapse: collapse;
             width:24px;
             height:24px;
         }
         table.oki {
             border: 1px;
             border-style: solid;
             border-color: black;
             border-collapse: collapse;
         }
         td.oki {
             border: 0px;
             border-style: solid;
             border-collapse: collapse;
             width:24px;
             height:24px;
         }
         input {
             width:24px;
             height:24px;
         }
         div#a {
             height: 300px;
         }
         div#b , div#c {
             height: 70px;
         }
         div#all {
             height: 470px;
             width: 100%;
             border: 1px black;
             margin: 0 ;
         }
        </style>
	<?php
        session_start();
        print "<span style=\"font-size:12px\">部屋".$_SESSION['heya']."</span>";
	?>
        <div id="all">
	    <div id="c">
		<div>
		    
		    <table class="oki">
			<?php
			session_start();
			if ($_SESSION['myteban'] != 1)
			{
			    for ($i=0;$i<2;$i++){
				print "<tr>\n";
				for ($j=0;$j<10;$j++){
				    $num=101+($i*10)+$j;
				    print "<td class=\"oki\"><input type=\"hidden\" id=\"".$num."\" value=\"0\" onClick=\"move(".$num.")\"></td>\n";
				}
				print "</tr>\n";
			    }
			}
			else 
			{
			    for ($i=0;$i<2;$i++){
				print "<tr>\n";
				for ($j=0;$j<10;$j++){
				    $num=81+($i*10)+$j;
				    print "<td class=\"oki\"><input type=\"hidden\" id=\"".$num."\" value=\"0\" onClick=\"move(".$num.")\"></td>\n";
				}
				print "</tr>\n";
			    }
			}
			?>
		    </table>
		</div>
	    </div>
	    <div id="a">
		<div>
		    <table class="ban">
			<?php
			session_start();
			if ($_SESSION['myteban'] != 1)
			{
			    for ($i=0;$i<9;$i++)
			    {
				print "<tr>\n";
				for ($j=0;$j<9;$j++)
				{
				    $num = $i*9+$j;
				    print "<td class=\"ban\"><input type=\"hidden\" id=\"".$num."\" value=\"0\" onClick=\"move(".$num.")\"></td>\n";
				}
				if ($i==0)
				{
				    print "<td style=\"width:45px;border:none\"><input id=\"gote\" style=\"height:20px;width:45px;font-size:10px;border:none\"></td>\n";
				    print "<td style=\"width:45px;border:none\"><input id=\"ghantei\" style=\"height:20px;width:45px;font-size:15px;border:none\"></td>\n";
				}
				if ($i==8)
				{
				    print "<td style=\"width:45px;border:none\"><input id=\"sente\" style=\"height:20px;width:45px;font-size:10px;border:none\"></td>\n";
				    print "<td style=\"width:45px;border:none\"><input id=\"shantei\" style=\"height:20px;width:45px;font-size:15px;border:none\"></td>\n";
				}
				print"</tr>\n";
			    }
			}
			else
			{
			    for ($i=0;$i<9;$i++)
			    {
				print "<tr>\n";
				for ($j=0;$j<9;$j++)
				{
				    $num=80-$i*9-$j;
				    print "<td class=\"ban\"><input type=\"hidden\" id=\"".$num."\" value=\"0\" onClick=\"move(".$num.")\"></td>\n";
				}
				if ($i==0)
				{
				    print "<td style=\"width:45px;border:none\"><input id=\"sente\" style=\"height:20px;width:45px;font-size:10px;border:none\"></td>\n";
				    print "<td style=\"width:45px;border:none\"><input id=\"shantei\" style=\"height:20px;width:45px;font-size:15px;border:none\"></td>\n";
				}
				if ($i==8)
				{
				    print "<td style=\"width:45px;border:none\"><input id=\"gote\" style=\"height:20px;width:45px;font-size:10px;border:none\"></td>\n";
				    print "<td style=\"width:45px;border:none\"><input id=\"ghantei\" style=\"height:20px;width:45px;font-size:15px;border:none\"></td>\n";
				}
				print"</tr>\n";
			    }
			}
			?>
		    </table>
		</div>
	    </div>
	    <div id="b">
		<div>
		    <table class="oki">
			<?php
			session_start();
			if ($_SESSION['myteban'] != 1)
			{
			    for ($i=0;$i<2;$i++){
				print "<tr>\n";
				for ($j=0;$j<10;$j++){
				    $num = 81+($i*10)+$j;
				    print "<td class=\"oki\"><input type=\"hidden\" id=\"".$num."\" value=\"0\" onClick=\"move(".$num.")\"></td>\n";
				}
				print "</tr>\n";
			    }
			}
			else
			{
			    for ($i=0;$i<2;$i++){
				print "<tr>\n";
				for ($j=0;$j<10;$j++){
				    $num=101+($i*10)+$j;
				    print "<td class=\"oki\"><input type=\"hidden\" id=\"".$num."\" value=\"0\" onClick=\"move(".$num.")\"></td>\n";
				}
				print "</tr>\n";
			    }
			}
			?>
		    </table>
		</div>
	    </div>
	    <div>
		<input type="button" value="←" onClick="update(0)" style="width:80px;height:40px;font-size:20px">
		<input type="button" value="→" onClick="update(1)" style="width:80px;height:40px;font-size:20px">
		<input type="text" id="tesu" value="" style="width:80px;height:40px;font-size:20px;border:none">
		<input type="button" value="戻る" onClick="location.href='ban.php'" style="width:80px;height:40px;font-size:20px">
	    </div>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	    <script type="text/javascript"> 
	     <?php
	     session_start();
	     print "var myteban = ".$_SESSION['myteban'].";\n";
	     print "var banid = ".$_SESSION['heya'].";\n";
	     $con = mysql_connect('localhost','account','password'); 
	     $db = mysql_select_db('shogi',$con);
	     $sql = "select count(*) from kifu where id=".$_SESSION['heya'];
	     $result = mysql_query($sql);
	     $row = mysql_fetch_assoc($result);
	     $count = $row['count(*)'];
	     print "var max = ".$count.";\n";
	     ?>
	     var teban=0;
	     function update(updown){
		 if (updown == 0){
		     if(teban != 0) 
			 {
			     teban = teban - 1;
			 }
		 }
		 else
		     {
			 if (max - 1 > teban){
			     teban = teban + 1;
			 }
		     }
		 $.ajax({
		     url: 'update_kifu.php',
		     type: 'post',
		     dataType: 'json',
		     data: {
			 id: banid,
			 teban: teban
		     }
		 })
		  .done(function (response){
		      var str=response.data[0];
		      document.getElementById("sente").value = response.data[1];
		      document.getElementById("gote").value = response.data[2];
		      document.getElementById("tesu").value = teban+"手目";
		      for (var i = 0 ; i < 121 ; i++)
			  {
			      var piece=str.substr(i*2,2);
			      if (piece.substr(0,1)=="0")
				  {
				      piece=str.substr(i*2+1,1);
				  }
			      var num = parseInt(piece);
			      document.getElementById(String(i)).value = num;
			      document.getElementById(String(i)).type = "image";
			      if (myteban != 1){                           
				  if (num == 0){document.getElementById(String(i)).src = "shogi/cell.png";}
				  else if (num == 1){document.getElementById(String(i)).src = "shogi/Sfu.png";}
				  else if (num == 2){document.getElementById(String(i)).src = "shogi/Skyo.png";}
				  else if (num == 3){document.getElementById(String(i)).src = "shogi/Skei.png";}
				  else if (num == 4){document.getElementById(String(i)).src = "shogi/Sgin.png";}
				  else if (num == 5){document.getElementById(String(i)).src = "shogi/Skin.png";}
				  else if (num == 6){document.getElementById(String(i)).src = "shogi/Skaku.png";}
				  else if (num == 7){document.getElementById(String(i)).src = "shogi/Shi.png";}
				  else if (num == 8){document.getElementById(String(i)).src = "shogi/Sou.png";}
				  else if (num == 9){document.getElementById(String(i)).src = "shogi/Sto.png";}
				  else if (num == 10){document.getElementById(String(i)).src = "shogi/Snkyo.png";}
				  else if (num == 11){document.getElementById(String(i)).src = "shogi/Snkei.png";}
				  else if (num == 12){document.getElementById(String(i)).src = "shogi/Sngin.png";}
				  else if (num == 13){document.getElementById(String(i)).src = "shogi/Suma.png";}
				  else if (num == 14){document.getElementById(String(i)).src = "shogi/Sryu.png";}
				  else if (num == 15){document.getElementById(String(i)).src = "shogi/Gfu.png";}
				  else if (num == 16){document.getElementById(String(i)).src = "shogi/Gkyo.png";}
				  else if (num == 17){document.getElementById(String(i)).src = "shogi/Gkei.png";}
				  else if (num == 18){document.getElementById(String(i)).src = "shogi/Ggin.png";}
				  else if (num == 19){document.getElementById(String(i)).src = "shogi/Gkin.png";}
				  else if (num == 20){document.getElementById(String(i)).src = "shogi/Gkaku.png";}
				  else if (num == 21){document.getElementById(String(i)).src = "shogi/Ghi.png";}
				  else if (num == 22){document.getElementById(String(i)).src = "shogi/Gou.png";}
				  else if (num == 23){document.getElementById(String(i)).src = "shogi/Gto.png";}
				  else if (num == 24){document.getElementById(String(i)).src = "shogi/Gnkyo.png";}
				  else if (num == 25){document.getElementById(String(i)).src = "shogi/Gnkei.png";}
				  else if (num == 26){document.getElementById(String(i)).src = "shogi/Gngin.png";}
				  else if (num == 27){document.getElementById(String(i)).src = "shogi/Guma.png";}
				  else if (num == 28){document.getElementById(String(i)).src = "shogi/Gryu.png";}
			      }
			      else if (myteban == 1)
				  {
				      if (num == 0){document.getElementById(String(i)).src = "shogi/cell.png";}
				      else if (num == 1){document.getElementById(String(i)).src = "shogi/Gfu.png";}
				      else if (num == 2){document.getElementById(String(i)).src = "shogi/Gkyo.png";}
				      else if (num == 3){document.getElementById(String(i)).src = "shogi/Gkei.png";}
				      else if (num == 4){document.getElementById(String(i)).src = "shogi/Ggin.png";}
				      else if (num == 5){document.getElementById(String(i)).src = "shogi/Gkin.png";}
				      else if (num == 6){document.getElementById(String(i)).src = "shogi/Gkaku.png";}
				      else if (num == 7){document.getElementById(String(i)).src = "shogi/Ghi.png";}
				      else if (num == 8){document.getElementById(String(i)).src = "shogi/Gou.png";}
				      else if (num == 9){document.getElementById(String(i)).src = "shogi/Gto.png";}
				      else if (num == 10){document.getElementById(String(i)).src = "shogi/Gnkyo.png";}
				      else if (num == 11){document.getElementById(String(i)).src = "shogi/Gnkei.png";}
				      else if (num == 12){document.getElementById(String(i)).src = "shogi/Gngin.png";}
				      else if (num == 13){document.getElementById(String(i)).src = "shogi/Guma.png";}
				      else if (num == 14){document.getElementById(String(i)).src = "shogi/Gryu.png";}
				      else if (num == 15){document.getElementById(String(i)).src = "shogi/Sfu.png";}
				      else if (num == 16){document.getElementById(String(i)).src = "shogi/Skyo.png";}
				      else if (num == 17){document.getElementById(String(i)).src = "shogi/Skei.png";}
				      else if (num == 18){document.getElementById(String(i)).src = "shogi/Sgin.png";}
				      else if (num == 19){document.getElementById(String(i)).src = "shogi/Skin.png";}
				      else if (num == 20){document.getElementById(String(i)).src = "shogi/Skaku.png";}
				      else if (num == 21){document.getElementById(String(i)).src = "shogi/Shi.png";}
				      else if (num == 22){document.getElementById(String(i)).src = "shogi/Sou.png";}
				      else if (num == 23){document.getElementById(String(i)).src = "shogi/Sto.png";}
				      else if (num == 24){document.getElementById(String(i)).src = "shogi/Snkyo.png";}
				      else if (num == 25){document.getElementById(String(i)).src = "shogi/Snkei.png";}
				      else if (num == 26){document.getElementById(String(i)).src = "shogi/Sngin.png";}
				      else if (num == 27){document.getElementById(String(i)).src = "shogi/Suma.png";}
				      else if (num == 28){document.getElementById(String(i)).src = "shogi/Sryu.png";}
				  }
			  }
		  });
	     }
	     window.onload = function init () {
		 update(0);
	     }
	    </script>
    </body>
</html>


