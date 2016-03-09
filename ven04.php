<?php 
    require_once 'inc/conn.php';
    $req = $pdo->prepare("SELECT  p.bloc, p.id as place, r.id as res, u.firstname, u.lastname, u.address, u.code, u.localite,u.country, u.telephone, u.email
                            FROM cd16_places_04 p
                            LEFT outer JOIN cd16_reservations r ON p.spectateurs_id = r.id
                            LEFT OUTER JOIN cd16_users u ON r.user_id = u.id
                            ORDER BY p.id; ");
    $req->execute();
if(isset($_POST['btnSearchNom'])){
    $req = $pdo->prepare("SELECT  p.bloc, p.id as place, r.id as res, u.firstname, u.lastname, u.address, u.code, u.localite,u.country, u.telephone, u.email
                            FROM cd16_places_04 p
                            LEFT outer JOIN cd16_reservations r ON p.spectateurs_id = r.id
                            LEFT OUTER JOIN cd16_users u ON r.user_id = u.id
                            WHERE u.lastname like '".$_POST['searchNom']."%'
                            ORDER BY p.id; ");
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
      <a class="navbar-brand" href="#">Places du Vendredi 04</a>
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
  </div><!-- /.container-fluid -->
</nav>

<div class="col-md-12">
    <table class="table table-striped table-hover ">
        <thead>
            <th>Bloc</th>
            <th>Place</th>
            <th>N°Rés.</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Code</th>
            <th>Localité</th>
            <th>Pays</th>
            <th>Téléphone</th>
            <th>E-Mail</th>
            
        </thead>
        <tbody>
            <?php while($res = $req->fetch()): ?>
            <tr>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: left;"><?= $res->place; ?></td>
                <td style="text-align: left;"><?= $res->res; ?></td>
                <td style="text-align: left;color:red;"><?= strtoupper($res->lastname); ?></td>
                <td style="text-align: left;"><?= $res->firstname; ?></td>
                <td style="text-align: left;"><?= $res->address; ?></td>
                <td style="text-align: left;"><?= $res->code; ?></td>
                <td style="text-align: left;"><?= $res->localite; ?></td>
                <td style="text-align: left;"><?= $res->country; ?></td>
                <td style="text-align: left;"><?= $res->telephone; ?></td>
                <td style="text-align: left;"><?= $res->email; ?></td>
             </tr>
             <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require 'inc/footer.php';