<?php

$result = array();
$reserv = $_POST['reserv'];

require_once 'conn.php';
$req = $pdo->prepare("SELECT * FROM cd16_reservations  WHERE id= ? ");
$req->execute([$reserv]);
$laReserv = $req->fetch();

$bloc = $laReserv->bloc;
$jour = $laReserv->jour;
if ($jour == "ABN3J") {
    $j = "04";
} else {
    $j = substr($jour, 3);
}
//echo $bloc."--".$jour;

$reqP = $pdo->prepare("SELECT * FROM cd16_places_" . $j . "  WHERE bloc= ? AND spectateurs_id = 0");
$reqP->execute([$bloc]);
while ($row = $reqP->fetch()) {
    $myrow = array();
    $myrow = array('label' => $row->id,
        'title' => $row->id,
        'value' => $row->id);
    array_push($result, $myrow);
};
echo json_encode($result);
