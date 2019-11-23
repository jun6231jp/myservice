<?php

header('Content-Type: application/json charset=UTF-8');

$path=$_POST['path'];
$mod=$_POST['mod'];

$res=exec('sudo chmod '.$mod.' '.$path);

if ($res==0){
$data="success";
}
else {
$data="fail";
}
echo json_encode(compact('data'));
