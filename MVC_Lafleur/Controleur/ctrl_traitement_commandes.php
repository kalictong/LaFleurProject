<?php
	require ("Modele/modele_traitement_commandes.php");
	
	$rc = new TraitementDAO();
	
	
	
	$valid=$rc->valid();
	// si la requete a fonctionner pour traiter la commande
	if($valid)
	{	
		//On vide le panier
		require ("Modele/modele_fonctions_panier.php");
		$fp = new PanierDAO();
		$supprimerPanier=$fp->supprimePanier();
		//Affichage d'un message de confirmation
		echo"<script> alert ('Votre commande a été prise en compte ! Merci');</script>";
		//Redirection vers la page d'accueil
		print ("<script language = \"JavaScript\">");
		print ("location.href = 'index.php';");
		print ("</script>");
	  }
	else
	{
		echo "<script> alert ('Votre commande n'a pas été prise en compte !');</script>" ;
		include ("Vue/vue_panier.php");
    }
	

?>