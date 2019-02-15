<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dijkstra
 *
 * @author etudiant
 */
class Dijkstra {
    //put your code here
    private $graphe = null;
	private $depart = null;
	private $arrivee = null;
	private $chemin_minimal = array();
	private $distance_minimale = Noeud::C_INFINI;

	function __construct (Graphe $g) {
		$this->graphe = $g;
	}
	
	function getArrivee() {return $this->arrivee;}
	function getGraphe() {return $this->graphe;}
	function getDepart() {return $this->depart;}
	function getChemin_minimal() {return $this->chemin_minimal;}	
	function getDistance_minimale() {return $this->distance_minimale;}	

	function setGraphe(Graphe $g) {$this->graphe = $g;}

	function setArrivee(Noeud $d) {
		if (!in_array($d, $this->graphe->getTab_noeud() )) {
			return false;
		}
		$this->arrivee = $d;
		if ($d != null) {
			return true;
		}
		else return false;
		
	}
	
	function setDepart(Noeud $d) {
		if (!in_array($d, $this->graphe->getTab_noeud() )) {
			return false;
		}
		$this->depart = $d;
		foreach($this->graphe->getTab_noeud() as $noeud) {
			$noeud->init();
		}

		$chemin_minimal = array();
		$distance_minimale = Noeud::C_INFINI;
		if ($this->depart != null) {
			$this->depart->setValeur(0);
			
			$this->graphe->set_noeud_selectionne($this->depart);
			$this->actualise_valeur_noeuds();
			return true;
		}
		else return false;
	}
	
	function print_valeur_noeuds() {
		$str = "";
		$val = $this->graphe->get_noeuds_valeurs();
		print_r($val);
		echo"<br>";
	}
	
	function print_valeur_noeuds_par_nom() {
		$str = "";
		$val = $this->graphe->get_noeuds_valeurs_par_nom();
		print_r($val);
		echo"<br>";
	}
	
	# actualise la valeur des noeuds qui suivent celui qui est sélectionné
	function actualise_valeur_noeuds() {
		$rc = 0;
		$selection = $this->graphe->get_noeud_selectionne();
		if ($selection != null) {
			list($tab_noeuds, $tab_valeur_arc) = $this->graphe->get_noeuds_suivants_non_marques_depuis_noeud_selectionne();
			if ($tab_noeuds != null) {
				foreach($tab_noeuds as $cle => $noeud) {
					$nouvelle_valeur = $selection->getValeur() + $tab_valeur_arc[$cle];
					if ($nouvelle_valeur < $noeud->getValeur()) {
						$noeud->setValeur($nouvelle_valeur);
						$noeud->setNoeud_precedent($selection);
					}
				}
			}
			else $rc = -1;

		}
		else $rc = -2;
		
		return ($rc);
	}
	
	#fonction principale qui effectue la recherche
	function recherche() {
		if ($this->getDepart() === null) {echo"le noeud de départ n'est pas précisé<br>"; return false;}
		if ($this->getArrivee() === null) {echo"le noeud d'arrivé n'est pas précisé<br>"; return false;}
		$iteration = 0;
		$noeud = $this->etape_recherche();
		
		while ($noeud !== null) {
			$iteration++;
			#echoln("iteration $iteration");
			//$this->print_valeur_noeuds_par_nom();
			$noeud = $this->etape_recherche();
		}
		
		$distmin = $this->getArrivee()->getValeur();
		$this->distance_minimale = $distmin;
		if ($distmin == Noeud::C_INFINI) {
			return false;
		}
		else {
			$this->calcule_chemin();
			return true;
		}
	}
	
	# depuis le noeud sélectionné en paramètre on cherche l'arc de moindre valeur conduisant aux noeuds suivants
	# le noeud pointé par l'arc minimal devient sélectionné tandis que l'ancien passe à 'traité'
	# retourne la nouvelle sélection
	private function etape_recherche() {
		$rc = 0;
		
		# 1/ recherche du noeud à valeur minimal non marqué
			#1.1/ Recherche des noeuds non marqués
			$noeuds = $this->graphe->get_noeuds_non_traites();
			if ( ($noeuds == null) or (count($noeuds) == 0) ) {
				//echo"tous les noeuds sont traités<br>";
				return null;
			}
		
			#1.2/ Parmi eux, recherche de celui qui a la valeur minimale
			$valeur_min = Noeud::C_INFINI;
			$cle_min = "";
			foreach($noeuds as $cle=>$n) {
				if ($n->getValeur() < $valeur_min) {
					$valeur_min = $n->getValeur();
					$cle_min = $cle;
				}
			}

			#1.3/ Sivaleur_min est infinie, c'est que les noeuds non marqués ont tous une valeur infinie : soient il n'y a pas de chemin qui vont 
			# d'eux à l'arrivée, soit il n'y a pas de chemin qui vont du noeud départ à eux => le processus est alors arrêté
			if ($valeur_min == Noeud::C_INFINI) {
				return null;
			}
		
		# 2/ sélectionner ce noeud
		$this->graphe->set_noeud_selectionne($noeuds[$cle_min]);
		
		# 3/ pour tout successeur non traité du noeud sélectionné, 
		# la valeur du successeur est au plus égale à 
		# la valeur du noeud sélectionné + la valeur de l'arc qui relie le noeud sélectionné au successeur
		$this->actualise_valeur_noeuds();
		
		# 4/ marquage du noeud sélectionné
		$selection = $this->graphe->get_noeud_selectionne();
		$selection->setEtat("traité");
		
		return $selection;
	}
	
	# calcule le chemin minimal du point de départ au point d'arrivée sous forme de tableau de noeuds.
	# retourne le nombre d'étapes pour y parvenir
	public function calcule_chemin() {
		$chemin = array();
		$noeud = $this->getArrivee();
		while ($noeud !== null) {
			$chemin[] = $noeud;
			$noeud = $noeud->getNoeud_precedent();
		}
		$chemin = array_reverse($chemin);
		$this->chemin_minimal = $chemin;
		return count($chemin);
	}
	
	# retourne le chemin minimal sous forme de chaîne de caractères
	public function get_string_chemin() {
		$path = "";
                $list = array();
                
		foreach($this->chemin_minimal as $etape) {
                    //$path .= ", " . $etape->getNom();
                    $list[] = $etape->getNom();
		}
                
		//$path = substr($path, 2);
		return $list;
	}
}
