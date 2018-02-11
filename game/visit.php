<?php

header('Content-Type: application/json charset=UTF-8');

$id=intval($_POST['heya']);
session_start();
$_SESSION['heya']=$id;
$_SESSION['myteban']=2;
$data=$id;
echo json_encode(compact(data));
