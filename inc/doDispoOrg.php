<?php
require_once 'conn.php';
$jour=$_GET['jour'];
$org = 'AFT'; // id de l'organisateur
// transformation du jour 
switch ($jour) {
    case "ven":
        $jourReserv="VEN04";
        break;
    case "sam":
        $jourReserv="SAM05";
        break;
    case "dim":
        $jourReserv="DIM06";
        break;
}

$req = $pdo->prepare("SELECT * FROM cd16_blocs_".$jour );
$req->execute();

while($res = $req->fetch()){
    $Ubloc = strtoupper(str_replace("_", " ", $res->name));
    $reqReserv = $pdo->prepare("SELECT SUM(r.nbplaces) as splaces, SUM(r.nbplaces_half) as splaces_half FROM cd16_reservations as r, cd16_users as u WHERE r.user_id= u.id AND r.bloc=? AND u.lastname=? AND r.jour=? GROUP BY r.bloc ");
    //$reqReserv = $pdo->prepare("SELECT SUM(nbplaces) as splaces, SUM(nbplaces_half) as splaces_half FROM cd16_reservations WHERE (bloc=? AND jour =? AND supprime_le IS NULL) OR (bloc=? AND jour='ABN3J' AND supprime_le IS NULL)");
    $reqReserv->execute(array($Ubloc, $org, $jourReserv));
    $resReserv = $reqReserv->fetch();
    // pour reservation countrytickets
    $somme = intval($resReserv->splaces) - intval($resReserv->splaces_half);
    echo $Ubloc." = ".$res->max_org." & ".$somme."<br />";
    if($somme == 0){
        $reqUpdate=$pdo->prepare("UPDATE cd16_blocs_".$jour." SET places_org=max_org WHERE name=?" );
        $reqUpdate->execute(array($res->name));
    }else{
        $valeur = intval($res->max_org) - intval($somme);
        $reqUpdate=$pdo->prepare("UPDATE cd16_blocs_".$jour." SET places_org=? WHERE name=?" );
        $reqUpdate->execute(array($valeur, $res->name));
    }
}