<?php
function SQL2date($dt)
{
  $dat=  explode("-",$dt);
    if (count($dat)==3) return sprintf("%02d/%02d/%4d",$dat[2],$dat[1],$dat[0]);
}
    $result = array();
    include 'conn.php';
	
$id=$_GET['id'];
	
    $req = $pdo->prepare("SELECT  *, r.id as rid FROM cd16_reservations as r, cd16_users as u WHERE r.user_id= u.id AND r.id=? ");
    $req->execute([$id]);
    
$today = date("d/m/Y");
$row = $req->fetch();
//var_dump($row);
//die();
$j = substr($row->jour, 3);
if ($j == "3J"){
    $typePlace = "Un abonnement 3 jours";
}else{
    $typePlace = "Ticket(s) 1 jour";
}
$name=  strtoupper($row->lastname);
$firstname=$row->firstname;
$adresse=$row->address;
$zip=$row->code;
$local=$row->localite;
$pays= $row->country;
$email=$row->email;
$phone=$row->telephone;
$jour = $row->jour;
$bloc = $row->bloc;
$type=$row->type;
$nbplaces=$row->nbplaces;
$nbplacesHalf = $row->nbplaces_half;
$montant = $row->montant;
$reserve_le = SQL2date($row->reserve_le);
$paye_le = SQL2date($row->paye_le);
$envoye_le = SQL2date($row->envoye_le);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>ENVOI</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/pdf.css" rel="stylesheet" />
    </head>
    <body>
        <div class="bloc_entete">
            <strong>COUNTRYTICKETS.EU</strong><br />
            -------<br />
            Billetterie du Country Hall de Liège<br />
            ---<br />
            e-mail: info@countrytickets.eu<br />

            <div style='height: 50px;'></div>
            <h4>COUPE DAVIS : BELGIQUE - CROATIE</h4><br />
            <h2><?= $j ?> MARS 2016 </h2><br />
            ---<br />
            <h1><?= $jour?> - <?= $id?></h1><br />
        </div>
        <div class="bloc_date_adresse">
            <p>Liège, le <?= $today; ?></P>
            <div style='height: 60px;'></div>
            <p>N°: <?= $id?></p>
            <?= $name?> <?= $firstname?><br />
            <?= $adresse?><br />
           <?= $zip?> <?= $local?><br />
           <?= $pays?>
        </div>
        <div class="bloc_principal">
        Madame, Monsieur,<br />
        Nous avons bien reçu votre paiement de <?= $montant?> € et avons le plaisir de vous faire parvenir:
        <ul>
            <li><?= $typePlace; ?></li>
            <li><?= $nbplaces ?> adulte(s)</li>
            <li><?= $nbplacesHalf ?> enfant(s)</li>
             <li>Bloc: <?= $bloc?></li>
            <li>Réservé le: <?= $reserve_le?></li>
        </ul>
        <div style='height: 20px;'></div>
        En vous remerciant<br />
        </div> <!-- fin bloc principal -->
        <div class="bloc_signature">
            <p>Countrytickets.eu </p>
        </div> <!-- fin bloc signature -->
    </body>
</html>
