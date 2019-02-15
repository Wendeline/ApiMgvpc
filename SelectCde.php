<?php

//$numcde = $_GET['numCde'];
$tb = array();

include 'connexion.php';

$req = "Select * from commandes where etatcde = 'en attente'";
$traitement = $connect ->prepare($req);
    $traitement -> execute();

if ($row = $traitement->fetch()){
    $numcde = $row['numCde'];
    
    if ($row['etatCde']=="en attente"){
        $req3 = "Update commandes set etatCde = 'en préparation' where numCde = ?";
        $traitement3 = $connect -> prepare($req3);
        $traitement3 -> bindParam(1,$numcde);
        $traitement3 -> execute();
        
        $req2 = "Select * from comporter c,produits p where p.idProd = c.idProd and numCde=? group by p.emplacement asc";
        $traitement2 = $connect->prepare($req2);
        $traitement2 -> bindParam(1,$numcde);
        $traitement2 -> execute();
        
        array_push($tb, $numcde);
        while ($row2 = $traitement2->fetch()){
            /*$req4 = "Update produits set stockProd=? where idProd = ?";
            $traitement4 = $connect->prepare($req4);
            $traitement4 -> bindParam(1,$row2['qte']);// J'ai pas stockProd
            $traitement4 -> bindParam(2,$row2['idProd']);
            $traitement4 -> execute();*/
            
                    
            $commande = array($row2['idProd'],$row2['emplacement'], $row2['libProd'],$row2['qte']);
            array_push($tb,$commande);
        }
        echo $js  = json_encode($tb);
    }else{
        echo 'erreur';
    }
}
else {
    echo 'YOUSK2';
}