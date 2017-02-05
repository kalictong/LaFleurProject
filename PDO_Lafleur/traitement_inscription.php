<?php
  //connection au serveur
  require_once("modeles/connexionBDD.php");
 
 //récupération des valeurs des champs:
 $nom=$_POST['ins_nom'];
 $prenom=$_POST['ins_prenom'];
 $adresse=$_POST['ins_adresse'];
 $cp=$_POST['ins_CP'];
 $ville=$_POST['ins_ville'];
 $email=$_POST['ins_email'];
 $pass=md5($_POST['pass']);
	//requête permettant de vérifier la présence ou non d'un login d'utilisateur
   $sql = "SELECT ins_email FROM client WHERE ins_email = '".$_POST["ins_email"]."' ";
   $uneRequete = Connexion::getInstance()->query($sql);
   $uneRequete->execute();
   //Renvoie le nombre de ligne présent (0 = aucune données présentes)
   //Si le login de l'utilisateur n'est pas présent dans la base de données on l'insère
   
   $nb=0;
   if($user=$uneRequete->fetch(PDO::FETCH_OBJ))
   {
		$nb=1;
   }
	
 if($nb==0){
	//création de la requête SQL:
	$sql2 = "INSERT  INTO client(ins_nom, ins_prenom, ins_adresse, ins_CP, ins_ville, ins_email, pass)
            VALUES (:nom, :prenom,:adresse, :cp,:ville,:email,:pass) " ;
	
	$requete2 = Connexion::getInstance()->prepare($sql2);
	
	//J'associe les valeur
	$requete2->bindValue(":nom",$nom,PDO::PARAM_STR);
	$requete2->bindValue(":prenom",$prenom,PDO::PARAM_STR);
	$requete2->bindValue(":adresse",$adresse,PDO::PARAM_STR);	
	$requete2->bindValue(":cp",$cp,PDO::PARAM_STR);	
	$requete2->bindValue(":ville",$ville,PDO::PARAM_STR);	
	$requete2->bindValue(":email",$email,PDO::PARAM_STR);	
	$requete2->bindValue(":pass",$pass,PDO::PARAM_STR);	

	//exécution de la requête SQL:
	$requete2->execute();

  //affichage d'un message de validation d'inscription
  if($requete2)
  {
    echo"<script> alert ('Votre inscription a été prise en compte !');</script>";
    // et redirection vers la page d'accueil
    print ("<script language = \"JavaScript\">");
    print ("location.href = 'index.php';");
    print ("</script>");
  }
  else
  {
    echo "<script> alert ('Votre inscription a échoué !');</script>" ;
  }
  
  }
  //Sinon on affiche un message d'erreur
  else
  {
      echo"<script> alert('Email déja présent dans la base de données !');</script>";
	  // et redirection vers la page d'inscription
      print ("<script language = \"JavaScript\">");
      print ("location.href = 'Inscription.php';");
      print ("</script>");
  }
?>