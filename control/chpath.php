<?php

header('Content-Type: application/json charset=UTF-8');

session_start();
$path=$_POST['path'];
$_SESSION['oldpath']=$_SESSION['path'];
$_SESSION['path']=$path;


$data=$path;
echo json_encode(compact('data'));
