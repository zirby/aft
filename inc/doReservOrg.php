<?php
require_once 'conn.php';


// créer le user avec lastname=AFT et firstname=leBeneficiaire et récupérer le id
$owner = $_POST['inputBeneficiaire'];
$req = $pdo->prepare("INSERT INTO cd16_users SET lastname = 'AFT', firstname = ?");
$req->execute([$owner]);
$user_id = $pdo->lastInsertId();



$places = $_POST['inputPlaces'];
$placeshalf = $_POST['inputPlacesHalf'];

$montant = $_POST['inputMontant'];

$type = $_POST['inputType'];

$jour = $_POST['day'];
switch ($jour) {
    case "ven":
        $jourReserv="VEN04";
        $grandJour="VENDREDI";
        $couleurJour="success";
        break;
    case "sam":
        $jourReserv="SAM05";
        $grandJour="SAMEDI";
        $couleurJour="info";
        break;
    case "dim":
        $jourReserv="DIM06";
        $grandJour="DIMANCHE";
        $couleurJour="warning";
        break;
}
$bloc = $_POST['bloc'];




$req = $pdo->prepare("INSERT INTO cd16_reservations SET user_id = ?,  jour = ?, type = ?, bloc = ?, nbplaces = ?, nbplaces_half = ?,  montant = ?, reserve_le = NOW()");
$req->execute([$user_id,  $jourReserv, $type, $bloc, $places, $placeshalf, $montant]);

header('Location:../org_reserv.php?jour='.$jour);
exit();