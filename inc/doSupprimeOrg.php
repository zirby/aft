<?php

$reserv = $_GET['reserv'];

require_once 'conn.php';
$req = $pdo->prepare("DELETE  FROM cd16_reservations WHERE id= ? ");
$rs = $req->execute(array($reserv));
header('Location:../index.php');
exit();

