<?php
header('Content-Type: application/json charset=UTF-8');

session_start();

$_SESSION['X']=$_POST['X'];
$_SESSION['Y']=$_POST['Y'];
$_SESSION['bombs']=$_POST['mine'];

$exe="/var/www/html/Game/mine.out ".$_POST['X']." ".$_POST['Y']." ".$_POST['mine'];

$mine=exec($exe);
$_SESSION['mine']=$mine;

$data=$exe;
echo json_encode(compact(data));

?>
