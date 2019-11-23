<?php

header('Content-Type: application/json charset=UTF-8');

$path=$_POST['path'];
$grp=$_POST['grp'];

$res=exec('sudo chgrp '.$grp.' '.$path);

if ($res==0){
$data="success";
}
else {
$data="fail";
}
echo json_encode(compact('data'));

