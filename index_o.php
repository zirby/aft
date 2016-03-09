<?php
    require_once 'inc/conn.php';
    $req = $pdo->prepare("SELECT  *, r.id as rid FROM cd16_reservations as r, cd16_users as u WHERE r.user_id= u.id ORDER BY r.id DESC  ");
    $req->execute();

if(isset($_POST['btnSearchReserv'])){
    $req = $pdo->prepare("SELECT  *, r.id as rid FROM cd16_reservations as r, cd16_users as u WHERE r.user_id= u.id AND r.id=".$_POST['searchReserv']." ORDER BY r.id DESC  ");
    $req->execute();
}
if(isset($_POST['btnSearchNom'])){
    $req = $pdo->prepare("SELECT  *, r.id as rid FROM cd16_reservations as r, cd16_users as u WHERE r.user_id= u.id AND u.lastname like '".$_POST['searchNom']."%' ORDER BY r.id DESC  ");
    $req->execute();
}
?>
<?php require 'inc/header.php'; ?>

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
        <li><button id="btnSuppAuto" type="button" class="btn btn-danger navbar-btn"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Suppression automatique</button></li>
      </ul>
        <form action="" method="POST" class="navbar-form navbar-right" role="search">
        <div class="form-group">
            <input name="searchNom" type="text" class="form-control" placeholder="Search">
        </div>
            <button name="btnSearchNom" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
      </form>
      <form action="" method="POST" class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input name="searchReserv" type="text" class="form-control" placeholder="Search">
        </div>
          <button name="btnSearchReserv" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="col-md-12">
    <table class="table table-striped table-hover ">
        <thead>
            <th>N°</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Jour</th>
            <th>Bloc</th>
            <th>Pl.Adulte</th>
            <th>Pl.Enfant</th>
            <th style="text-align: right;">Montant</th>
            <th style="text-align: right;">Réservé le</th>
            <th style="text-align: right;">Payé le</th>
            <th style="text-align: right;">Envoyé le</th>
            <th style="text-align: right;">Supprimé le</th>
            <th style="text-align: right;">Action</th>
        </thead>
        <tbody>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = intval($res->nbplaces)+intval($res->nbplaces_half); ?>
            <tr>
                <td style="text-align: left;"><?= $res->rid; ?></td>
                <td style="text-align: left;color:red;"><?= strtoupper($res->lastname); ?></td>
                <td style="text-align: left;"><?= $res->firstname; ?></td>
                <td style="text-align: left;color:green;"><?= $res->jour; ?></td>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: left;"><?= $res->nbplaces; ?></td>
                <td style="text-align: left;"><?= $res->nbplaces_half; ?></td>
                <td style="text-align: right;"><?= $res->montant; ?> €</td>
                <td style="text-align: right;"><?= $res->reserve_le; ?></td>
                <td style="text-align: right;"><?= $res->paye_le; ?></td>
                <td style="text-align: right;"><?= $res->envoye_le; ?></td>
                <td style="text-align: right;"><?= $res->supprime_le; ?></td>
                <td style="text-align: right;">
                    <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="<?= $res->rid; ?>"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span></a>
                    <a href="inc/printReservation.php?id=<?= $res->rid; ?>" class="btn btn-info btn-xs" title="imprimer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="#" class="btn btn-success btn-xs" title="attribuer les places" data-toggle="modal" data-target=".bs-places-modal-sm" data-id="<?= $res->rid; ?>" data-jour="<?= $res->jour; ?>" data-nbplaces="<?= $totPlaces; ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
                    <a href="inc/doEnvoyeLe.php?reserv=<?= $res->rid; ?>" class="btn btn-success btn-xs" title="envoyer"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></a>
                    <a href="inc/doAccepteLe.php?reserv=<?= $res->rid; ?>" class="btn btn-danger btn-xs" title="accepter"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                    <a href="inc/doSupprimeLe.php?reserv=<?= $res->rid; ?>" class="btn btn-danger btn-xs" title="supprimer"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                </td>
             </tr>
             <?php endwhile; ?>
        </tbody>
    </table>
</div>
<!-- Modal PAYE LE-->
<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Réservation</h4>
      </div>
     <form action="" method="POST">
         <div class="modal-body ">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Réservation n°:</label>
                <input name="Nreserve" id="Nreserve" type="text" class="form-control" id="recipient-name">
                </div>
             <strong> Payé le:</strong>
          <div class="form-group">
              <div id="dtPaye"></div>
          </div>
        </div>
        <div class="modal-footer">
             <button  id="btnPayeLeReset" type="button" class="btn btn-primary">Reset</button>
        </div>
     </form>
    </div>
  </div>
</div>

<!-- Modal doPlaces-->

<div class="modal fade bs-places-modal-sm" id="placesModal" tabindex="-1" role="dialog" aria-labelledby="placesModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="envoyeModalLabel">Attribuer les places</h4>
      </div>
     <form action="inc/doPlacesReserv.php" method="POST">
         <div class="modal-body ">
            <div class="form-group">
                <label for="NPreserve" class="control-label">Réservation n°:</label>
                <input name="NPreserve" id="NPreserve" type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label for="jour" class="control-label">Jour:</label>
                <input name="jour" id="jour" type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label for="nbplaces" class="control-label">Nb de Places:</label>
                <input name="nbplaces" id="nbplaces" type="text" class="form-control" >
            </div>
            <strong> Les places:</strong>
            <div class="form-group">
                <select id="selPlaces" name="selPlaces[]"  multiple="multiple"></select>
            </div>
        </div>
        <div class="modal-footer">
            <button name="btnDoPlaces" id="btnDoPlaces" type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
     </form>
    </div>
  </div>
</div>
<?php require 'inc/footer.php';
