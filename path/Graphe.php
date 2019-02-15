<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Graphe
 *
 * @author etudiant
 */
class Graphe {
    //put your code here
    private $tab_noeud = array();
	private $tab_arc = array();
	
	function __construct(Array $n, array $a) {
		$this->tab_noeud = $n;
		$this->tab_arc = $a;
	}

	function getTab_noeud() {return $this->tab_noeud;}
	function getTab_arc() {return $this->tab_arc;}
	function setTab_noeud(Array $t) {$this->tab_noeud = $t;}
	function setTab_arc(Array $t) {$this->tab_arc = $t;}
	
	function get_nb_noeuds() { return count($this->tab_noeud);}
	function get_nb_arcs() { return count($this->tab_arc);}
	// retourne l'arc éventuel contenant les deux noeuds précisés
	function get_arc(Noeud $d, Noeud $a) {
		foreach($this->tab_arc as $arc) {
			if ($arc->noeud_depart == $d and $arc->noeud_arrivee == $a) return $arc;
		}
		return null;
	}
	
	function print_arcs() {
		$arcs = $this->getTab_arc();
		foreach($arcs as $arc) echo $arc . "<br>";
	}

	// retourne un tableau de noeuds connectés au noeud spécifié par un arc du graphe, avec sa valeur
	// dans toutes ces méthodes il faudrait vérifier que le noeud en paramètre est bien un noeud du graphe...
	public function get_noeuds_suivants(Noeud $n) {
		$liste_noeuds = array();
		$liste_valeurs = array();
		foreach($this->tab_arc as $arc) {
			if ($arc->getNoeud_depart() == $n) {
				$liste_noeuds[]  = $arc->getNoeud_arrivee();
				$liste_valeurs[] = $arc->getValeur();
			}
		}
		
		return array($liste_noeuds, $liste_valeurs);
	}
	
	function get_noeuds_valeurs () {
		$resultat = array();
		foreach($this->tab_noeud as $noeud) {
			$resultat[$noeud->getId()] = $noeud->getValeur();
		}
		return $resultat;
	}

	function get_noeuds_valeurs_par_nom () {
		$resultat = array();
		foreach($this->tab_noeud as $noeud) {
			$resultat[$noeud->getNom()] = $noeud->getValeur();
		}
		return $resultat;
	}
	
	# retourne le noeud sélectionné. Il ne doit y en avoir qu'un, ce contrôle n'est pas fait.
	function get_noeud_selectionne() {
		foreach($this->tab_noeud as $noeud) {
			if ($noeud->getEtat() == "sélectionné") return $noeud;
		}
		return null;
	}
	
	#retourne les noeuds non traités
	function get_noeuds_non_traites() {
		$tab_noeuds_non_traites = array();
		$tab_valeur_noeuds_non_traites = array();
		
		foreach($this->tab_noeud as $noeud) {
			if ($noeud->getEtat() == "aucun") {
				$tab_noeuds_non_traites[] = $noeud;
			}
		}
		return $tab_noeuds_non_traites;
	}
	
	
	function set_noeud_selectionne(Noeud $n) {
		$ancien_noeud_selection = $this->get_noeud_selectionne();
		if ($ancien_noeud_selection != null) $ancien_noeud_selection->setEtat("traité");
		$n->setEtat("sélectionné");
	}

	
	# retourne les noeuds non marqués qui suivent le noeud sélectionné. 
	# Pour chaque noeud, retourne aussi la valeur de l'arc entre le noeud sélectionné et ce noeud
	function get_noeuds_suivants_non_marques_depuis_noeud_selectionne() {
		$tab_noeud_non_marque = array();
		$tab_valeur_arc = array();

		$selection = $this->get_noeud_selectionne();
		list($noeuds, $valeurs_arcs) = $this->get_noeuds_suivants($selection);
		if ($noeuds !== null) {
			foreach($noeuds as $cle => $n) {
				if ($n->getEtat() == "aucun") {
					$tab_noeud_non_marque[] = $n;
					$tab_valeur_arc[] = $valeurs_arcs[$cle];
				}
			}
			return array($tab_noeud_non_marque, $tab_valeur_arc);
		} 
		else return array(null, null);
		 
	}
}
