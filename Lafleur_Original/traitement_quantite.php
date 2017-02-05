<?php

  session_start();
  // fonctions utilisées pour le panier
  include("fonctions-panier.php");

  //connection au serveur
  $cnx = mysql_connect( "localhost", "root", "" ) ;
 
  //sélection de la base de données:
  $db  = mysql_select_db( "LAFLEUR_BDD" ) ;
 
  //récupération des valeurs des champs

  $nrocommande=uniqid();//numéro de commande | uniqid() génère un identifiant unique
  $date=date('y/m/d');//date du jour au format AAAA-MM-JJ
  $client=$_SESSION['nro_client'];//numéro d'identification du client

  //Booléen permettant de vérifier l'éxécution de la requête
  $valid=true;
  
  //Insertion dans la table commande
  $sql="INSERT INTO commande (nro_commande,date_commande,nro_client)
        VALUES ('$nrocommande','$date','$client')";
  //exécution de la requête SQL
  $requete = mysql_query($sql, $cnx) or die( mysql_error()) ;
  if(!$requete){$valid=false;}
  
  //Pour chaque référence dans le panier
  foreach($_SESSION["panier"]["pdt_ref"] as $cle => $valeur){
    //création de la requête SQL (insertion des éléments dans la table ligne_commande)
    $sql2 = "INSERT  INTO ligne_commande(nro_commande, pdt_ref, prix_fixe, qte_commande)
            VALUES ('$nrocommande', '{$_SESSION['panier']['pdt_ref'][$cle]}','{$_SESSION['panier']['pdt_prix'][$cle]}','{$_SESSION['panier']['quantite'][$cle]}') " ;

    //exécution de la requête SQL
    $requete = mysql_query($sql2, $cnx) or die( mysql_error()) ;
    if(!$requete){$valid=false;}
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