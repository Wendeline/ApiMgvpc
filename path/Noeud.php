<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Noeud
 *
 * @author etudiant
 */
class Noeud {
    //put your code here
    const C_INFINI = '1000000000';
	
	private $id;
	private $nom = "";
	private $numero = 0;
	private $etat = "aucun";
	private $valeur = self::C_INFINI;
	private $noeud_precedent = null;
	
	function __construct ($id, $nom = "") {
		$this->id = $id;
		$this->nom = $nom;
	}
	
	function __toString() {
		return $this->nom;
	}
	
	function getId() {return $this->id;}
	function getNom() {return $this->nom;}
	function getNumero() {return $this->numero;}
	function getEtat() {return $this->etat;}
	function getValeur() {return $this->valeur;}
	function getNoeud_precedent() {return $this->noeud_precedent;}

	function setId($id) {$this->id = $id;}
	function setNom($nom) {$this->nom = $nom;}
	function setNumero($numero) {$this->numero = $numero;}
	function setEtat($etat) {$this->etat = $etat;}
	function setValeur($valeur) {$this->valeur = $valeur;}
	function setNoeud_precedent(noeud $np) {$this->noeud_precedent = $np;}
	
	function init() {
		$this->etat = "aucun";
		$this->valeur = self::C_INFINI;
		$this->noeud_precedent = null;
	}
}
