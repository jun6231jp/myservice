<!DOCTYPE html>
<!--
     歩　ID=1　　　と　ID=9
     香　ID=2　　　成香　ID=10
     桂　ID=3　　　成桂　ID=11
     銀　ID=4　　　成銀　ID=12
     金　ID=5　　　
     角　ID=6　　　馬　ID=13
     飛　ID=7　　　龍　ID=14
     玉　ID=8   

     歩'　ID=15　　　と'　ID=23
     香'　ID=16　　　成香'　ID=24
     桂'　ID=17　　　成桂'　ID=25
     銀'　ID=18　　　成銀'　ID=26
     金'　ID=19　　　
     角'　ID=20　　　馬　ID=27
     飛'　ID=21　　　龍　ID=28
     王 　ID=22　
-->

<html>
    <head>
        <title>Shogi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <style>
         table.ban {
             border-style: solid;
             border: 0px;
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
         .sel {
             width:20px;
             height:20px;
             border : 2px;
             border-style: solid;
             border-color: blue;
         }
         .highlight {
             width:22px;
             height:22px;
             border : 1px;
             border-style: solid;
             border-color: black;
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
				if ($i > 1 && $i < 7)
				{
				    print "<td colspan=3 style=\"width:150px;border:none\"><input id=\"chat".($i-2)."\" style=\"height:25px;width:150px;font-size:10px;border:none\"></td>\n";
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
				if ($i > 1 && $i < 7)
				{
				    print "<td colspan=3 style=\"width:150px;border:none\"><input id=\"chat".($i-2)."\" style=\"height:25px;width:150px;font-size:10px;border:none\"></td>\n";
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
		<input type="text" id="msg" style="width:230px;height:20px;font-size:10px">
		<input type="button" value="▲" onClick="chat()" style="width:80px;height:20px;font-size:10px">
            </div>
            <div>
		<input type="button" value="退室" onClick="location.href='index.php'" style="width:80px;height:20px;font-size:10px">
		<input type="button" value="初期化" onClick="init()" style="width:80px;height:20px;font-size:10px">
		<input type="button" value="投了" onClick="resign()" style="width:80px;height:20px;font-size:10px">

		<input type="button" value="棋譜" onClick="location.href='kifu.php'" style="width:80px;height:20px;font-size:10px">
            </div>

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	    <script type="text/javascript"> 
	     <?php
	     session_start();
	     print "var banid = ".$_SESSION['heya'].";\n";
	     print "var myteban = ".$_SESSION['myteban'].";\n";
	     print "var name = '".$_SESSION['name']."';\n";
	     ?>
             var before=-1;
             var after = 0;
             var teban=0;
             function chat(){
                 if(document.getElementById("msg").value != "")
                     {
			 var msg = document.getElementById("msg").value;
                         $.ajax({ 
                             url: 'chat.php',
                             type: 'post',
                             dataType: 'json',
			     data: {
				 id: banid,
				 name: name,
				 msg: msg
                             }
			 })
			  .done(function (response){
                              document.getElementById("msg").value = "";
			  });
                     }
             }
             function resign(){
                 if(myteban==0 || myteban==1){
                     if(window.confirm('投了しますか？')){ 
                         $.ajax({
                             url: 'resign.php',
                             type: 'post',
                             dataType: 'json',
                             data: {
				 id: banid,
				 teban:myteban 
                             }
			 });
                     }
		 }
             }
             function init(){
		 if(myteban==0 || myteban==1){
                     if(window.confirm('初期化しますか？')){
			 $.ajax({
                             url: 'init.php',
                             type: 'post',
                             dataType: 'json',
                             data: {
				 id: banid
                             }
			 })
			  .done(function(response){
                              for(var i =0;i<81;i++){
				  document.getElementById(String(i)).className="";
                              }
			  }) ;
                     }
		 }
             }
             function update(){
		 $.ajax({
                     url: 'update.php',
                     type: 'post',
                     dataType: 'json',
                     data: {
			 id: banid
                     }
		 })
		  .done(function (response){
                      var str=response.data[0];
                      document.getElementById("sente").value = response.data[1];
                      document.getElementById("gote").value = response.data[2];
                      if (response.data[3]==0)
			  {
			      document.getElementById("shantei").value="負け";
			      document.getElementById("ghantei").value="勝ち";
			  }
                      else if (response.data[3]==1)
			  {
			      document.getElementById("shantei").value="勝ち";
			      document.getElementById("ghantei").value="負け";
			  }
                      else
			  {
			      document.getElementById("shantei").value="";
			      document.getElementById("ghantei").value="";
			  }
                      if (response.data[4] != null)
			  {
			      for (var i = 0; i < 81; i++)
				  {
				      if (document.getElementById(String(i)).className != "sel"){
					  document.getElementById(String(i)).className="";
				      }
				  }
			      document.getElementById(response.data[4]).className="highlight";
			  }
                      else
			  {
			      for (var i = 0; i < 81; i++)
				  {
				      if (document.getElementById(String(i)).className != "sel"){
					  document.getElementById(String(i)).className="";
				      }
				  }
			  }
                      if (response.data[5]!=""){
			  document.getElementById("chat0").value=response.data[5]+":"+response.data[6];
                      }
                      else{document.getElementById("chat0").value="";}
                      if (response.data[7]!=""){
			  document.getElementById("chat1").value=response.data[7]+":"+response.data[8];
                      }
                      else{document.getElementById("chat1").value="";}
                      if(response.data[9]!=""){
                          document.getElementById("chat2").value=response.data[9]+":"+response.data[10];
                      }
                      else{document.getElementById("chat2").value="";}
                      if (response.data[11]!=""){
                          document.getElementById("chat3").value=response.data[11]+":"+response.data[12];
                      }
                      else{document.getElementById("chat3").value="";}
                      if (response.data[13]!=""){
                          document.getElementById("chat4").value=response.data[13]+":"+response.data[14];
                      }
                      else{document.getElementById("chat4").value="";}
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
                      teban=1-parseInt(str.substr(242,1));
                  });
             }
             function move(id){
                 if (teban==myteban)
                     {
			 if (before==-1)
			     {
				 if ((teban==0 && document.getElementById(String(id)).value < 15) ||  (teban==1 && document.getElementById(String(id)).value > 14)) {
				     if (document.getElementById(String(id)).value != 0)
					 {
					     document.getElementById(String(id)).className="sel";
					     before = id;
					 }
				 }
			     }
			 else if (id == before){
                             before = -1 ;
                             document.getElementById(String(id)).className="";
			 }
			 else
			     {
				 if ((document.getElementById(String(id)).value == 0)|| (teban==0 && document.getElementById(String(id)).value > 14) || (teban==1 && document.getElementById(String(id)).value < 15))
				     {
					 after = id;
					 var str = "";
					 var nari = 0;
					 var koma_before= document.getElementById(String(before)).value;
					 var koma_after = document.getElementById(String(id)).value;
					 var flag = 0;
					 if ((koma_before < 8 && teban == 0) || (koma_before > 14 && koma_before < 22 && teban == 1))
					     {
						 if(koma_before!=5 && koma_before!=8 && koma_before!=19 && koma_before!=22)
						     {
							 if (teban==1 && id > 53 && before < 81)
							     {
								 flag = 1;
							     }
							 else if (teban==0 && id < 27 && before < 81)
							     {
								 flag = 1; 
							     }
							 else if (teban==1 && before > 53 && before < 81)
							     {
								 flag = 1; 
							     }
							 else if (teban==0 && before < 27 && before < 81)
							     {
								 flag = 1; 
							     }
						     }
					     }
					 if(flag == 1)
					     {
						 if(window.confirm('成りますか？'))
						     {
							 nari = 1;
						     }      
					     }
					 for (var i = 0 ; i < 121 ; i++)
					     {
						 if (document.getElementById(String(i)).value < 10)
						     {
							 str = str + "0";
							 str = str + String(document.getElementById(String(i)).value) ;
						     }
						 else
						     {
							 str = str + String(document.getElementById(String(i)).value) ;
						     }
					     }
					 $.ajax({
					     url: 'move.php',
					     type: 'post',
					     dataType: 'json', 
					     data: {
						 id: banid,
						 str: str,
						 before: before,
						 after: after,
						 teban: teban,
						 nari: nari
					     }
					 })
					  .done(function (response) {
					      document.getElementById(String(before)).className="";    
					      before=-1;
					      after = 0;
					      teban = 1 - teban ;
					  });
				     }                    
			     }
                     }
             }
             window.onload = function startfnc()
             {
                 setInterval("update()",2000);
             }
            </script>
    </body>
</html>


