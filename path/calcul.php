<?php

include_once("Dijkstra.php");
include_once ("Graphe.php");
include_once ("Arc.php");
include_once ("Noeud.php");

// DEPART
switch ($_GET['dp']) {
    case "A1" : $dp = "0";break;
    case "A2" : $dp = "1";break;
    case "A3" : $dp = "2";break;
    case "A4" : $dp = "3";break;
    case "B1" : $dp = "4";break;
    case "B2" : $dp = "5";break;
    case "B3" : $dp = "6";break;
    case "B4" : $dp = "7";break;
    case "C1" : $dp = "8";break;
    case "C2" : $dp = "9";break;
    case "C3" : $dp = "10";break;
    case "C4" : $dp = "11";break;
    case "D1" : $dp = "12";break;
    case "D2" : $dp = "13";break;
    case "D3" : $dp = "14";break;
    case "D4" : $dp = "15";break;
    case "E1" : $dp = "16";break;
    case "E2" : $dp = "17"; break;
    case "E3" : $dp = "18";break;
    case "E4" : $dp = "19";break;
    case "F1" : $dp = "20";break;
    case "F2" : $dp = "21";break;
    case "F3" : $dp = "22";break;
    case "F4" : $dp = "23";break;
}

switch ($_GET['ar']) {
    case "A1" : $ar = "0";break;
    case "A2" : $ar = "1";break;
    case "A3" : $ar = "2";break;
    case "A4" : $ar = "3";break;
    case "B1" : $ar = "4";break;
    case "B2" : $ar = "5";break;
    case "B3" : $ar = "6";break;
    case "B4" : $ar = "7";break;
    case "C1" : $ar = "8";break;
    case "C2" : $ar = "9";break;
    case "C3" : $ar = "10";break;
    case "C4" : $ar = "11";break;
    case "D1" : $ar = "12";break;
    case "D2" : $ar = "13";break;
    case "D3" : $ar = "14";break;
    case "D4" : $ar = "15";break;
    case "E1" : $ar = "16";break;
    case "E2" : $ar = "17"; break;
    case "E3" : $ar = "18";break;
    case "E4" : $ar = "19";break;
    case "F1" : $ar = "20";break;
    case "F2" : $ar = "21";break;
    case "F3" : $ar = "22";break;
    case "F4" : $ar = "23";break;
}


//notre plan en quelque sorte avec les points présent dessus
$n = array();
$i = 0; $n[$i] = new Noeud($i, 'A.1'); 
$i = 1; $n[$i] = new Noeud($i, 'A.2');
$i = 2; $n[$i] = new Noeud($i, 'A.3');
$i = 3; $n[$i] = new Noeud($i, 'A.4');

$i = 4; $n[$i] = new Noeud($i, 'B.1'); 
$i = 5; $n[$i] = new Noeud($i, 'B.2');
$i = 6; $n[$i] = new Noeud($i, 'B.3');
$i = 7; $n[$i] = new Noeud($i, 'B.4');

$i = 8; $n[$i] = new Noeud($i, 'C.1'); 
$i = 9; $n[$i] = new Noeud($i, 'C.2');
$i = 10; $n[$i] = new Noeud($i, 'C.3');
$i = 11; $n[$i] = new Noeud($i, 'C.4');

$i = 12; $n[$i] = new Noeud($i, 'D.1'); 
$i = 13; $n[$i] = new Noeud($i, 'D.2');
$i = 14; $n[$i] = new Noeud($i, 'D.3');
$i = 15; $n[$i] = new Noeud($i, 'D.4');

$i = 16; $n[$i] = new Noeud($i, 'E.1'); 
$i = 17; $n[$i] = new Noeud($i, 'E.2');
$i = 18; $n[$i] = new Noeud($i, 'E.3');
$i = 19; $n[$i] = new Noeud($i, 'E.4');

$i = 20; $n[$i] = new Noeud($i, 'F.1'); 
$i = 21; $n[$i] = new Noeud($i, 'F.2');
$i = 22; $n[$i] = new Noeud($i, 'F.3');
$i = 23; $n[$i] = new Noeud($i, 'F.4');

$tab_arc = array(  
			new Arc($n[0], $n[1], 1), 
			new Arc($n[1], $n[2], 1), 
			new Arc($n[2], $n[3], 1),  
			new Arc($n[3], $n[2], 1), 
			new Arc($n[2], $n[1], 1), 
			new Arc($n[1], $n[0], 1),
    
    new Arc($n[0], $n[4], 1), 
    new Arc($n[1], $n[5], 1), 
    new Arc($n[2], $n[6], 1), 
    new Arc($n[3], $n[7], 1),
    new Arc($n[4], $n[0], 1), 
    new Arc($n[5], $n[1], 1), 
    new Arc($n[6], $n[2], 1), 
    new Arc($n[7], $n[3], 1),
    
                        new Arc($n[4], $n[5], 1), 
			new Arc($n[5], $n[6], 1), 
			new Arc($n[6], $n[7], 1), 
			new Arc($n[7], $n[6], 1),
                        new Arc($n[6], $n[5], 1), 
			new Arc($n[5], $n[4], 1), 
    
    new Arc($n[4], $n[8], 1), 
    new Arc($n[8], $n[4], 1),
    new Arc($n[7], $n[11], 1), 
    new Arc($n[11], $n[7], 1),
    
                        new Arc($n[8], $n[9], 1), 
			new Arc($n[9], $n[10], 1), 
			new Arc($n[10], $n[11], 1), 
			new Arc($n[11], $n[10], 1),
                        new Arc($n[10], $n[9], 1), 
			new Arc($n[9], $n[8], 1), 
    
    new Arc($n[8], $n[12], 1), 
    new Arc($n[9], $n[13], 1), 
    new Arc($n[10], $n[14], 1), 
    new Arc($n[11], $n[15], 1),
    new Arc($n[12], $n[8], 1), 
    new Arc($n[13], $n[9], 1), 
    new Arc($n[14], $n[10], 1), 
    new Arc($n[15], $n[11], 1),
    
                        new Arc($n[12], $n[13], 1), 
			new Arc($n[13], $n[14], 1), 
			new Arc($n[14], $n[15], 1), 
			new Arc($n[15], $n[14], 1),
                        new Arc($n[14], $n[13], 1), 
			new Arc($n[13], $n[12], 1), 
    
    new Arc($n[12], $n[16], 1), 
    new Arc($n[16], $n[12], 1),
    new Arc($n[15], $n[19], 1), 
    new Arc($n[19], $n[15], 1),
    
                        new Arc($n[16], $n[17], 1), 
			new Arc($n[17], $n[18], 1), 
			new Arc($n[18], $n[19], 1), 
			new Arc($n[19], $n[18], 1),
                        new Arc($n[18], $n[17], 1), 
			new Arc($n[17], $n[16], 1), 
    
    new Arc($n[16], $n[20], 1), 
    new Arc($n[17], $n[21], 1), 
    new Arc($n[18], $n[22], 1), 
    new Arc($n[19], $n[23], 1),
    new Arc($n[20], $n[16], 1), 
    new Arc($n[21], $n[17], 1), 
    new Arc($n[22], $n[18], 1), 
    new Arc($n[23], $n[19], 1),
    
                        new Arc($n[20], $n[21], 1), 
			new Arc($n[21], $n[22], 1), 
			new Arc($n[22], $n[23], 1), 
			new Arc($n[23], $n[22], 1),
                        new Arc($n[22], $n[21], 1), 
			new Arc($n[21], $n[20], 1), 
    
);

$graphe = new Graphe($n, $tab_arc);
$dij = new Dijkstra($graphe);

$rc = $dij->setDepart ($n[$dp]);
$rc = $dij->setArrivee($n[$ar]);

if ($rc === true) {
	if ($dij->recherche()) {
		$chemin_str = $dij->get_string_chemin();
                echo json_encode($chemin_str);
		
                //echo"chemin : ". $chemin_str ." <br>";
		//echo"la distance la plus courte entre le noeud " . $dij->getDepart() . " et le noeud " . $dij->getArrivee() . " est " . $dij->getDistance_minimale()."<br>";
	}
	else echo"Il n'y a pas de chemin entre " . $dij->getDepart() . " et " . $dij->getArrivee()."<br>";
}
else {
	echo"Erreur d'initialisation<br>";
}


?>