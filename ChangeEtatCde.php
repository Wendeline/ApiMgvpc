<?php

$numcde = $_GET['numCde'];

include 'connexion.php';

$req = "Select * from commandes where numCde = ?";
$traitement = $connect ->prepare($req);
$traitement -> bindParam(1, $numcde);
    $traitement -> execute();

while($row = $traitement->fetch()){
    if ($row['etatCde']=="en préparation"){
        $req2 = "Update commandes set etatcde = 'préparation terminée' where numCde = ?";
        $traitement2 = $connect -> prepare($req2);
        $traitement2 -> bindParam(1,$numcde);
        $traitement2 -> execute();
        
        echo 'ok';
    }else{
        echo 'erreur';
    }
}