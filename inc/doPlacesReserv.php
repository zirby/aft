<?php
require_once 'conn.php';

$places = array();
$reserv = $_POST['NPreserve'];
$jour = $_POST['jour'];
$places = $_POST['selPlaces'];

if ($jour == "ABN3J") {
    foreach ($places as $place) {
        $req = $pdo->prepare("UPDATE cd16_places_04 SET spectateurs_id =?  WHERE id= ? ");
        $req->execute([$reserv, $place]);
        $req = $pdo->prepare("UPDATE cd16_places_05 SET spectateurs_id =?  WHERE id= ? ");
        $req->execute([$reserv, $place]);
        $req = $pdo->prepare("UPDATE cd16_places_06 SET spectateurs_id =?  WHERE id= ? ");
        $req->execute([$reserv, $place]);
    }
} else {
    $j = substr($jour, 3);
    foreach ($places as $place) {
        $req = $pdo->prepare("UPDATE cd16_places_".$j." SET spectateurs_id =?  WHERE id= ? ");
        $req->execute([$reserv, $place]);
    }
}

header('Location:../index.php');
    exit();