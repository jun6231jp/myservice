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
	<title>english top</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

    <h1>ENGLISH TOP<h1>
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


	    <p>
		<input type="submit" class="sw" id="word" value="Word List" onClick="location.href='word.php'"></input>
	    </p>

	    <p>
		<input type="submit" class="sw" id="question" value="TOEIC Menu" onClick="location.href='question.php'"></input>
	    </p>

	    <p>
		<input type="submit" class="sw" id="question" value="TOEIC Revise" onClick="location.href='question_rev.php'"></input>
	    </p>

	    <p>
		<input type="submit" class="sw" id="score" value="TOEIC Score" onClick="location.href='score_menu.php'"></input>
	    </p>


	    <p>
		<input type="submit" class="sw" id="graph" value="Graph" onClick="location.href='http://'+location.hostname+location.pathname+'graph.php'"></input>
	    </p>

	    <p>
		<input type="submit" class="sw" id="portal" value="Portal" onClick="location.href='../portal.php'"></input>
	    </p>

	</body>
</html>
