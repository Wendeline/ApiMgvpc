<?php

include 'connexion.php';

$req = "UPDATE `commandes` SET`etatCde`= 'en attente'";
$traitement = $connect ->prepare($req);
    $traitement -> execute();