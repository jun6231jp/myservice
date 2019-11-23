<?php

header('Content-Type: application/json charset=UTF-8');

$path=$_POST['path'];
$own=$_POST['own'];

$res=exec('sudo chown '.$own.' '.$path);

if ($res==0){
$data="success";
}
else {
$data="fail";
}
echo json_encode(compact('data'));
