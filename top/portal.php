<?php
session_start();
if (!$_SESSION['name']){
    exit;
} else {
    $name = $_SESSION['name'];
    $con = mysql_connect('localhost','account','password');
    $db = mysql_select_db('service',$con);
    $sql = "select * from servicelist where username = \"".$name."\"";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $serviceid = intval($row['serviceid']);
    $_SESSION['serviceid']=$serviceid;

    echo <<< EOM

    <!DOCTYPE html>
    <html>
    <head>
    <title>user login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

    <h1>PORTAL<h1>
    <style>
    input {
	max-width:100%;
	font-size:50px;
    }
   .sw {
       width: 100%;
       height: 170px;
   }
    </style>
    <body>

    EOM;

    if($serviceid >= 100000){
	echo <<< EOM
	<p>
	<input type="submit" class="sw" id="admin" value="User Control" onClick="location.href='control/index.php'"></input>
</p>
	
	<p>
	<input type="submit" class="sw" id="admin" value="Power Control" onClick="location.href='control/power.php'"></input>
	</p>
	
	EOM;
	$serviceid=$serviceid-100000;
    }
    if($serviceid >= 10000){
	echo <<< EOM
	<p>
	<input type="submit" class="sw" id="hhab" value="家計簿" onClick="location.href='hhab/'"></input>
	</p>
	
	EOM;
	$serviceid=$serviceid-10000;
    }
    if($serviceid >= 1000){
	echo <<< EOM
	<p>
	<input type="submit" class="sw" id="game" value="Game" onClick="location.href='Game/'"></input>
	</p>
	
	EOM;
	$serviceid=$serviceid-1000;
    }
    if($serviceid >= 100){
	echo <<< EOM
	<p>
	<input type="submit" class="sw" id="denken" value="資格" onClick="location.href='shikaku/'"></input>
	</p>
	
	EOM;
	$serviceid=$serviceid-100;
    }
    if($serviceid >= 10){
	echo <<< EOM
	<p>
	<input type="submit" class="sw" id="english" value="English" onClick="location.href='English/'"></input>
	</p>
	
	EOM;
	$serviceid=$serviceid-10;
    }
    
    echo <<< EOM
    
    <p>
    <input type="submit" class="sw" id="logout" value="Logout" onClick="location.href='index.php'"></input>
</p>
    
    EOM;
    echo <<< LAST
    </body>
    </html>
    LAST;
}
?>
