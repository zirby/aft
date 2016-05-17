<?php

require_once 'inc/conn.php';
$jour=$_GET['jour'];
// transformation du jour 
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
// faire doDispo ORG avec IDENTIFIANT de ORGANISATEUR
$org = 'AFT'; // id de l'organisateur
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
    //echo $Ubloc." = ".$res->max_org." & ".$somme."<br />";
    if($somme == 0){
        $reqUpdate=$pdo->prepare("UPDATE cd16_blocs_".$jour." SET places_org=max_org WHERE name=?" );
        $reqUpdate->execute(array($res->name));
    }else{
        $valeur = intval($res->max_org) - intval($somme);
        $reqUpdate=$pdo->prepare("UPDATE cd16_blocs_".$jour." SET places_org=? WHERE name=?" );
        $reqUpdate->execute(array($valeur, $res->name));
    }
}

// faire la liste des réservations
$req = $pdo->prepare("SELECT  *, r.id as rid FROM cd16_reservations as r, cd16_users as u WHERE r.user_id= u.id AND u.lastname='".$org."' AND jour='".$jourReserv."' ORDER BY r.id DESC  ");
$req->execute();


if(isset($_POST['btnSearchNom'])){
    $req = $pdo->prepare("SELECT  *, r.id as rid FROM cd16_reservations as r, cd16_users as u WHERE r.user_id= u.id AND u.firstname like '".$_POST['searchNom']."%' AND u.lastname='AFT' AND jour='".$jourReserv."' ORDER BY r.id DESC  ");
    $req->execute();
}


?>
<?php require 'inc/header.php'; ?>
<div id="jour" hidden="true"><?= $jour ?></div>
<div class="row text-center">
    <div class="col-md-12">
        <button type="button" class="btn btn-<?= $couleurJour ?>"><h2>Tickets - AFT - <?= $grandJour ?></h2></button>
    </div>
    <div class="col-md-12" style="height: 20px;"></div>
</div>
<div class="row">
<div id="jour" hidden="true">04</div>
<div class="col-md-6">
    <img src="img/Salle_600.jpg" alt="la salle" class="img-rounded displayed" usemap="#map-cd2016_600"/>
<map name="map-cd2016_600" id="map-cd2016_600">
<area id="bloc_a" alt="" title="" href="#" shape="rect" coords="155,266,209,345" />
<area id="bloc_b" alt="" title="" href="#" shape="rect" coords="158,223,207,260" />
<area id="bloc_c" alt="" title="" href="#" shape="rect" coords="160,181,205,218" />
<area id="bloc_d" alt="" title="" href="#" shape="rect" coords="156,91,209,175" />
<area id="bloc_e" alt="" title="" href="#" shape="rect" coords="218,180,245,221" />
<area id="bloc_f" alt="" title="" href="#" shape="rect" coords="217,265,244,324" />
<area id="bloc_g" alt="" title="" href="#" shape="rect" coords="153,61,228,85" />
<area id="bloc_h" alt="" title="" href="#" shape="rect" coords="229,60,304,84" />
<area id="bloc_i" alt="" title="" href="#" shape="rect" coords="307,60,382,84" />
<area id="bloc_j" alt="" title="" href="#" shape="rect" coords="383,59,458,83" />
<area id="bloc_k" alt="" title="" href="#" shape="rect" coords="458,60,533,84" />
<area id="bloc_l" alt="" title="" href="#" shape="rect" coords="479,90,533,138" />
<area id="bloc_m" alt="" title="" href="#" shape="rect" coords="478,142,532,190" />
<area id="bloc_n" alt="" title="" href="#" shape="rect" coords="478,196,532,244" />
<area id="bloc_o" alt="" title="" href="#" shape="rect" coords="478,246,532,294" />
<area id="bloc_p" alt="" title="" href="#" shape="rect" coords="478,299,532,347" />
<area id="bloc_q" alt="" title="" href="#" shape="rect" coords="442,123,472,213" />
<area id="bloc_r" alt="" title="" href="#" shape="rect" coords="442,225,472,315" />
<area id="bloc_s" alt="" title="" href="#" shape="rect" coords="463,356,526,381" />
<area id="bloc_t" alt="" title="" href="#" shape="rect" coords="388,369,437,400" />
<area id="bloc_u" alt="" title="" href="#" shape="rect" coords="300,368,387,399" />
<area id="bloc_v" alt="" title="" href="#" shape="rect" coords="253,367,302,398" />
<area id="bloc_x" alt="" title="" href="#" shape="rect" coords="160,357,220,381" />
<area id="bloc_a_sup" alt="" title="" href="#" shape="rect" coords="94,312,130,374" />
<area id="bloc_b_sup" alt="" title="" href="#" shape="rect" coords="94,245,130,307" />
<area id="bloc_c_sup" alt="" title="" href="#" shape="rect" coords="94,178,130,240" />
<area id="bloc_d_sup" alt="" title="" href="#" shape="rect" coords="94,109,130,171" />
<area id="bloc_e_sup" alt="" title="" href="#" shape="rect" coords="93,43,129,105" />
<area id="bloc_g_sup" alt="" title="" href="#" shape="rect" coords="135,13,214,43" />
<area id="bloc_h_sup" alt="" title="" href="#" shape="rect" coords="219,15,298,45" />
<area id="bloc_i_sup" alt="" title="" href="#" shape="rect" coords="305,14,384,44" />
<area id="bloc_j_sup" alt="" title="" href="#" shape="rect" coords="388,15,467,45" />
<area id="bloc_k_sup" alt="" title="" href="#" shape="rect" coords="473,15,552,45" />
<area id="bloc_l_sup" alt="" title="" href="#" shape="rect" coords="560,42,592,103" />
<area id="bloc_m_sup" alt="" title="" href="#" shape="rect" coords="561,109,593,170" />
<area id="bloc_n_sup" alt="" title="" href="#" shape="rect" coords="560,177,592,238" />
<area id="bloc_o_sup" alt="" title="" href="#" shape="rect" coords="558,242,590,303" />
<area id="bloc_p_sup" alt="" title="" href="#" shape="rect" coords="558,315,590,376" />
<area id="bloc_e0" alt="" title="" href="#" shape="rect" coords="217,118,244,177" />
<area id="bloc_f0" alt="" title="" href="#" shape="rect" coords="217,222,244,263" />
</map>

</div>
<div class="col-md-6">
    <div class="row">
        <div class="alert alert-success" role="alert">
            <p><strong>Places disponibles</strong></p>
            <p id="pBloc"></p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12"><p style="font-size: 1em;"><b> INDIQUEZ LE NOMBRE DE PLACES</b></p></div>
        <div class="col-md-6 ">
            <div class="input-group">
                <span class="input-group-addon">Adulte: </span>
                <input id="inputPlaces" type="text" class="form-control" value="0">
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="input-group">
                <span class="input-group-addon">Enfant: </span>
                <input id="inputPlacesHalf" type="text" class="form-control" value="0">
            </div>
        </div>
        <div class="col-md-12"><p style="font-size: 1em;"><b> PRECISEZ LE BENEFICIAIRE</b></p></div>
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">Bénéficiaire: </span>
                <input id="inputBeneficiaire" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-6"><p style="font-size: 1em;"><b> MONTANT</b></p></div>
        <div class="col-md-6"><p style="font-size: 1em;"><b> TYPE DE TICKET</b></p></div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon">Montant: </span>
                <input id="inputMontant" type="text" class="form-control" value="0">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon">Type: </span>
                <input id="inputType" type="text" class="form-control" value="0">
            </div>
        </div>

        <p id="salleHelp" style="font-size: 1em;"></p>
        <div class="col-md-12" style="height: 20px;"></div>
        <button id="btnReservOrg" type="button" class="btn btn-primary btn-lg">Réserver</button>
    </div>

</div>
</div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Réservations</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
        </ul>
        <ul class="nav navbar-nav navbar-right">
        </ul>
        <form action="" method="POST" class="navbar-form navbar-right" role="search">
          <div class="form-group">
              <input name="searchNom" type="text" class="form-control" placeholder="Search">
          </div>
              <button name="btnSearchNom" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
        </form>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>
<div class="col-md-12">
    <table class="table table-striped table-hover ">
        <thead>
            <th>N°</th>
            <th>Bénéficiaire</th>
            <th>Bloc</th>
            <th>Pl.Adulte</th>
            <th>Pl.Enfant</th>
            <th style="text-align: right;">Réservé le</th>
            <th style="text-align: right;">Action</th>
        </thead>
        <tbody>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = intval($res->nbplaces)+intval($res->nbplaces_half); ?>
            <tr>
                <td style="text-align: left;"><?= $res->rid; ?></td>
                <td style="text-align: left;color:red;"><?= strtoupper($res->firstname); ?></td>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: left;"><?= $res->nbplaces; ?></td>
                <td style="text-align: left;"><?= $res->nbplaces_half; ?></td>
                <td style="text-align: right;"><?= $res->reserve_le; ?></td>
                <td style="text-align: right;">
                    <a href="inc/doAccepteLe.php?reserv=<?= $res->rid; ?>" class="btn btn-default btn-xs" title="modifier"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="inc/doSupprimeLe.php?reserv=<?= $res->rid; ?>" class="btn btn-danger btn-xs" title="supprimer"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                </td>
             </tr>
             <?php endwhile; ?>
        </tbody>
    </table>
</div>



<?php require 'inc/footer.php';
