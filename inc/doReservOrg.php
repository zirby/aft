<?php
require_once 'conn.php';

$places = $_POST['inputPlaces'];
$placeshalf = $_POST['inputPlacesHalf'];
$owner = $_POST['inputBeneficiaire'];
$montant = $_POST['inputMontant'];
$type = $_POST['inputType'];
$day = $_POST['day'];
$bloc = $_POST['bloc'];
$user_id = $_POST['user_id'];



$req = $pdo->prepare("INSERT INTO cd16_reservations SET user_id = ?, owner = ?, jour = ?, type = ?, bloc = ?, nbplaces = ?, nbplaces_half = ?,  montant = ?, reserve_le = NOW()");
$req->execute([$user_id, $owner, $day, $type, $bloc, $places, $placeshalf, $montant]);

header('Location:../index.php');
exit();