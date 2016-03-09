<?php

$reserv = $_GET['reserv'];
$today = date("Y-m-d");
echo $dtEnvoyele;
require_once 'conn.php';
$req = $pdo->prepare("UPDATE cd16_reservations SET supprime_le =? WHERE id= ? ");
$rs = $req->execute([$today, $reserv]);
header('Location:../index.php');
exit();

