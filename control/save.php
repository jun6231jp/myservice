<?php

header('Content-Type: application/json charset=UTF-8');

//$data=escapeshellarg(escapeshellcmd($_POST['text']));
$data=$_POST['text'];
$data=escapeshellarg($data);
$path=$_POST['path'];
//file_put_contents($_POST['path'],$data);

exec("echo ".$data." | sudo tee ".$path);

echo json_encode(compact('data'));
