<?php

$reserv = $_GET['reserv'];
//echo $dtPayele;
    require_once 'conn.php';
    $req = $pdo->prepare("UPDATE cd16_reservations SET supprime_le =? WHERE id= ? ");
    $rs = $req->execute([$dtsupprimele, $reserv]);
    header('Location:../index.php');
    exit();
