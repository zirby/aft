<?php
require_once 'conn.php';

$places = $_POST['inputPlaces'];
$placeshalf = $_POST['inputPlacesHalf'];
$owner = $_POST['inputBeneficiaire'];
$montant = $_POST['inputMontant'];
$type = $_POST['inputType'];
$day = $_POST[''];
$bloc = $_POST['bloc'];


$req = $pdo->prepare("INSERT INTO cd16_reservations SET user_id = ?, jour = ?, zone = ?, bloc = ?, nbplaces = ?, montant = ?, reserve_le = NOW()");
$req->execute([$reserv, $place]);

header('Location:../index.php');
    exit();