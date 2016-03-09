<?php 
require_once 'inc/conn.php';

?>
<?php require 'inc/header.php'; ?>
<div class="row">
<div class="col-md-12 page-header">
    <h3>Réservation VENDREDI 04 mars</h3>
</div>

<div class="col-md-6">
    <table class="table table-striped table-hover ">
        <thead>
            <th>Bloc</th>
            <th style="text-align: right;">Nb. places réservées</th>
        </thead>
        <tbody>
            <?php $totPlaces = 0; ?>
            <?php $req = $pdo->prepare("SELECT bloc, SUM(nbplaces)+SUM(nbplaces_half) as tot FROM cd16_reservations WHERE (jour = 'VEN04' and paye_le is  null and supprime_le is null) OR  (jour = 'ABN3J' and paye_le is  null and supprime_le is null) GROUP BY bloc "); ?>
            <?php $req->execute(); ?>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = $totPlaces + intval($res->tot); ?>
            <tr>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: right;color:red;"><?= $res->tot; ?></td>
             </tr>
             <?php endwhile; ?>
            <tr>
                <td style="text-align: left;">Total</td>
                <td style="text-align: right;color:green;font-weight: bold;"><?= $totPlaces; ?></td>
             </tr>
        </tbody>
    </table>
</div>
<div class="col-md-6">
    <table class="table table-striped table-hover ">
        <thead>
            <th>Bloc</th>
            <th style="text-align: right;">Nb. places payées</th>
        </thead>
        <tbody>
            <?php $totPlaces = 0; ?>
            <?php $req = $pdo->prepare("SELECT bloc, SUM(nbplaces)+SUM(nbplaces_half) as tot FROM cd16_reservations WHERE (jour = 'VEN04' and paye_le is not null and supprime_le is null) OR  (jour = 'ABN3J' and paye_le is not  null and supprime_le is null) GROUP BY bloc "); ?>
            <?php $req->execute(); ?>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = $totPlaces + intval($res->tot); ?>
            <tr>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: right;color:red;"><?= $res->tot; ?></td>
             </tr>
             <?php endwhile; ?>
            <tr>
                <td style="text-align: left;">Total</td>
                <td style="text-align: right;color:green;font-weight: bold;"><?= $totPlaces; ?></td>
             </tr>
        </tbody>
    </table>
</div>
</div>
<div class="row">
<div class="col-md-12 page-header">
    <h3>Réservation SAMEDI 05 mars</h3>
</div>

<div class="col-md-6">
    <table class="table table-striped table-hover ">
        <thead>
            <th>Bloc</th>
            <th style="text-align: right;">Nb. places réservées</th>
        </thead>
        <tbody>
            <?php $totPlaces = 0; ?>
            <?php $req = $pdo->prepare("SELECT bloc, SUM(nbplaces)+SUM(nbplaces_half) as tot FROM cd16_reservations WHERE (jour = 'SAM05' and paye_le is  null and supprime_le is null) OR  (jour = 'ABN3J' and paye_le is  null and supprime_le is null) GROUP BY bloc "); ?>
            <?php $req->execute(); ?>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = $totPlaces + intval($res->tot); ?>
            <tr>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: right;color:red;"><?= $res->tot; ?></td>
             </tr>
             <?php endwhile; ?>
            <tr>
                <td style="text-align: left;">Total</td>
                <td style="text-align: right;color:green;font-weight: bold;"><?= $totPlaces; ?></td>
             </tr>
        </tbody>
    </table>
</div>
<div class="col-md-6">
    <table class="table table-striped table-hover ">
        <thead>
            <th>Bloc</th>
            <th style="text-align: right;">Nb. places payées</th>
        </thead>
        <tbody>
            <?php $totPlaces = 0; ?>
            <?php $req = $pdo->prepare("SELECT bloc, SUM(nbplaces)+SUM(nbplaces_half) as tot FROM cd16_reservations WHERE (jour = 'SAM05' and paye_le is not null and supprime_le is null) OR  (jour = 'ABN3J' and paye_le is not null and supprime_le is null) GROUP BY bloc "); ?>
            <?php $req->execute(); ?>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = $totPlaces + intval($res->tot); ?>
            <tr>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: right;color:red;"><?= $res->tot; ?></td>
             </tr>
             <?php endwhile; ?>
            <tr>
                <td style="text-align: left;">Total</td>
                <td style="text-align: right;color:green;font-weight: bold;"><?= $totPlaces; ?></td>
             </tr>
        </tbody>
    </table>
</div>
</div>
<div class="row">
<div class="col-md-12 page-header">
    <h3>Réservation DIMANCHE 06 mars</h3>
</div>

<div class="col-md-6">
    <table class="table table-striped table-hover ">
        <thead>
            <th>Bloc</th>
            <th style="text-align: right;">Nb. places réservées</th>
        </thead>
        <tbody>
            <?php $totPlaces = 0; ?>
            <?php $req = $pdo->prepare("SELECT bloc, SUM(nbplaces)+SUM(nbplaces_half) as tot FROM cd16_reservations WHERE (jour = 'DIM06' and paye_le is  null and supprime_le is null) OR  (jour = 'ABN3J' and paye_le is  null and supprime_le is null) GROUP BY bloc "); ?>
            <?php $req->execute(); ?>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = $totPlaces + intval($res->tot); ?>
            <tr>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: right;color:red;"><?= $res->tot; ?></td>
             </tr>
             <?php endwhile; ?>
            <tr>
                <td style="text-align: left;">Total</td>
                <td style="text-align: right;color:green;font-weight: bold;"><?= $totPlaces; ?></td>
             </tr>
        </tbody>
    </table>
</div>
<div class="col-md-6">
    <table class="table table-striped table-hover ">
        <thead>
            <th>Bloc</th>
            <th style="text-align: right;">Nb. places payées</th>
        </thead>
        <tbody>
            <?php $totPlaces = 0; ?>
            <?php $req = $pdo->prepare("SELECT bloc, SUM(nbplaces)+SUM(nbplaces_half) as tot FROM cd16_reservations WHERE (jour = 'DIM06' and paye_le is not null and supprime_le is null) OR  (jour = 'ABN3J' and paye_le is not null and supprime_le is null) GROUP BY bloc "); ?>
            <?php $req->execute(); ?>
            <?php while($res = $req->fetch()): ?>
            <?php $totPlaces = $totPlaces + intval($res->tot); ?>
            <tr>
                <td style="text-align: left;"><?= $res->bloc; ?></td>
                <td style="text-align: right;color:red;"><?= $res->tot; ?></td>
             </tr>
             <?php endwhile; ?>
            <tr>
                <td style="text-align: left;">Total</td>
                <td style="text-align: right;color:green;font-weight: bold;"><?= $totPlaces; ?></td>
             </tr>
        </tbody>
    </table>
</div>
</div>
<?php require 'inc/footer.php';