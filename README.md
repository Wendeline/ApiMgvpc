# MGVPC_API

calcule.php : Calcule la distance la plus courte entre deux emplacements 

	Besoin → dp et ar qui correspondent à l’emplacement de départ et d’arrivée

	Renvoie → Json avec le chemin à suivre

ChangeEtatCde.php : Passe l’état de “en préparation” à “préparation terminée”

	Besoin → numCde qui correspond au numéro de la commande

	Renvoie → Rien modifie juste la bd

Inutile Commande.php : Affiche toute les informations d’une commande (numéro, date, état, id des produits et leur quantité).

	Besoin → Rien

	Renvoie → Json avec toute les informations

SelectCde.php : Change l’état d’une commande de “en attente” à “en préparation” et affiche les produits de la commande avec le numéro de celle-ci.

	Besoin → Rien, elle prend la première commande “en attente” de la bd

	Renvoie → Json avec numCde et un tableau avec idProd, emplacement, libProd et la quantité

SystemTest_ResetLesCommandes.php : Mets toutes les commandes “en attente”.

	Besoin → Rien

	Renvoie → Rien modifie juste la bd


connexionApp.php : Permet la connexion dans l’application

Besoin → ?key=

	Renvoie → true | false


