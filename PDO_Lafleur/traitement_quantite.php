<?php

  session_start();
  // fonctions utilisées pour le panier
  include("fonctions-panier.php");

  //connextion a la base
  require_once('modeles/connexionBDD.php');
 
  //récupération des valeurs des champs

  $nrocommande=uniqid();//numéro de commande | uniqid() génère un identifiant unique
  $date=date('y/m/d');//date du jour au format AAAA-MM-JJ
  $client=$_SESSION['nro_client'];//numéro d'identification du client

  //Booléen permettant de vérifier l'éxécution de la requête
  $valid=true;
  
  //Insertion dans la table commande
  $sql="INSERT INTO commande (nro_commande,date_commande,nro_client)
        VALUES (:nrocommande,:date,:client)";
		
  //exécution de la requête SQL
  $requete = Connexion::getInstance()->prepare($sql);
  
  //J'associe les valeur
  $requete->bindValue(":nrocommande",$nrocommande,PDO::PARAM_STR);
  $requete->bindValue(":date",$date,PDO::PARAM_STR);
  $requete->bindValue(":client",$client,PDO::PARAM_STR);
  
  //exécution de la requête SQL:
  $requete->execute();
  
  if(!$requete){$valid=false;}
  
  //Pour chaque référence dans le panier
  foreach($_SESSION["panier"]["pdt_ref"] as $cle => $valeur){
    //création de la requête SQL (insertion des éléments dans la table ligne_commande)
    $sql2 = "INSERT  INTO ligne_commande(nro_commande, pdt_ref, prix_fixe, qte_commande)
            VALUES (:nrocommande, '{$_SESSION['panier']['pdt_ref'][$cle]}','{$_SESSION['panier']['pdt_prix'][$cle]}','{$_SESSION['panier']['quantite'][$cle]}') " ;

    //exécution de la requête SQL
    $requete2 = Connexion::getInstance()->prepare($sql2);
	
	//J'associe les valeur
    $requete2->bindValue(":nrocommande",$nrocommande,PDO::PARAM_STR);
  
	//exécution de la requête SQL:
	$requete2->execute();
	
    if(!$requete2){$valid=false;}
  }

  //si l'éxécution de la requête fonctionne (valid=true)
  if($valid)
  {
    //On vide le panier
    supprimePanier();
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
  }
   mysql_close();  // on ferme la connexion 
?>