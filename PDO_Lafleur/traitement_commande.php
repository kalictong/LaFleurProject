<?php
  session_start();
  
  
  // fonctions utilis�es pour le panier
  include("fonctions-panier.php");
 
  //r�cup�ration des valeurs des champs

  $nrocommande=uniqid();//num�ro de commande | uniqid() g�n�re un identifiant unique
  $date=date('y/m/d');//date du jour au format AAAA-MM-JJ
  $client=$_SESSION['nro_client'];//num�ro d'identification du client

  //Bool�en permettant de v�rifier l'�x�cution de la requ�te
  $valid=true;
  
  require_once("modeles/connexionBDD.php");
  
  //Insertion dans la table commande
  $sql="INSERT INTO commande (nro_commande,date_commande,nro_client)
        VALUES (:nrocommande,:date,:client)";
  //prepare la requete
  $requete1 = Connexion::getInstance()->prepare($sql);
  
  //jassocie les param�tre
  $requete1->bindValue(":nrocommande",$nrocommande,PDO::PARAM_STR);
  $requete1->bindValue(":date",$date,PDO::PARAM_STR);
  $requete1->bindValue(":client",$client,PDO::PARAM_STR);
  
  //ex�cution de la requ�te SQL
  $requete1->execute();
  if(!$requete1){$valid=false;}
  
  //Pour chaque r�f�rence dans le panier
  foreach($_SESSION["panier"]["pdt_ref"] as $cle => $valeur){
    //cr�ation de la requ�te SQL (insertion des �l�ments dans la table ligne_commande)
    $sql2 = "INSERT  INTO ligne_commande(nro_commande, pdt_ref, prix_fixe, qte_commande)
            VALUES (:nrocommande, '{$_SESSION['panier']['pdt_ref'][$cle]}','{$_SESSION['panier']['pdt_prix'][$cle]}','{$_SESSION['panier']['quantite'][$cle]}') " ;
	
	//je prepare la requete
	$requete2 = Connexion::getInstance()->prepare($sql2);

	//j'associe la requete
	$requete2->bindValue(":nrocommande",$nrocommande,PDO::PARAM_STR);
	
    //ex�cution de la requ�te SQL
	$requete2->execute();
    if(!$requete2){$valid=false;}
  }

  //si l'�x�cution de la requ�te fonctionne (valid=true)
  if($valid)
  {
    //On vide le panier
    supprimePanier();
    //Affichage d'un message de confirmation
    echo"<script> alert ('Votre commande a �t� prise en compte ! Merci');</script>";
    //Redirection vers la page d'accueil
    print ("<script language = \"JavaScript\">");
    print ("location.href = 'index.php';");
    print ("</script>");
  }
  else
  {
    echo "<script> alert ('Votre commande n'a pas �t� prise en compte !');</script>" ;
  }
?>