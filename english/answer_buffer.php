<?php

header('Content-Type: application/json charset=UTF-8');

session_start();
$_SESSION['qname']=$_POST['qname'];

$result = $_SESSION['qname'];
if ($result){
    $data = "{$_POST['qname']} start!";
    echo json_encode(compact('data'));
}

