<?php 
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = new DateTime($date_1);
    $datetime2 = new DateTime($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}

    $datedujour = date("Y-m-d");
    
    require_once 'conn.php';
    
    $req = $pdo->prepare("SELECT  * FROM cd16_reservations WHERE supprime_le IS NULL AND paye_le IS NULL ");
    $req->execute();
    while($row = $req->fetch()){
        $diffdate = dateDifference($datedujour, $row->reserve_le);
        //echo $diffdate."<br />";
        if($diffdate > 5){
            $reqU = $pdo->prepare("UPDATE cd16_reservations SET supprime_le = ? WHERE id=?");
            $reqU->execute([$datedujour, $row->id]);
        }
    }
    header('Location:../index.php');
    exit();

