<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Arc
 *
 * @author etudiant
 */
class Arc {
    //put your code here
    private $noeud_depart;
	private $noeud_arrivee;
	private $valeur;
	
	function __construct (Noeud $d, Noeud $a, $valeur) {
		$this->noeud_depart = $d;
		$this->noeud_arrivee = $a;
		$this->valeur = $valeur;
	}
	
	function __toString() {
		return $this->noeud_depart->getNom() . " -> " .  $this->noeud_arrivee->getNom() . " (" . $this->valeur . ")";
	}
	
	function getNoeud_depart() {return $this->noeud_depart;}
	function getNoeud_arrivee() {return $this->noeud_arrivee;}
	function getValeur() {return $this->valeur;}
	function setNoeud_depart(Noeud $n) {$this->noeud_depart = $n;}
	function setNoeud_arrivee(Noeud $n) {$this->noeud_arrivee = $n;}
	function setValeur($v) {$this->valeur = $v;}
}
