<?php

include 'connexion.php';

try{
            
    $req = "SELECT * FROM commandes cde, comporter cpt where cde.numCde = cpt.numCde and etatCde ='en attente' ";
    $traitement = $connect ->prepare($req);
    $traitement -> execute();
 
     $tb = array();
    
    while($row = $traitement->fetch()) {
        $commande = array($row['numCde'],$row['dateCde'],$row['etatCde'],$row['idProd'],$row['qte']);
        //$produit = array($row['idProd'],$row['qte']);
        
        array_push($tb,$commande);
        
    }
    echo $js  = json_encode($tb);
    
    
    
} catch (Exception $ex) {
    die('Erreur : '.$ex->getMessage());
}