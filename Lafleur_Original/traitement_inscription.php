<?php
  //connection au serveur
  $cnx = mysql_connect( "localhost", "root", "" ) ;
 
  //s�lection de la base de donn�es:
  $db  = mysql_select_db( "LAFLEUR_BDD" ) ;
 
 //r�cup�ration des valeurs des champs:
 $nom=$_POST['ins_nom'];
 $prenom=$_POST['ins_prenom'];
 $adresse=$_POST['ins_adresse'];
 $cp=$_POST['ins_CP'];
 $ville=$_POST['ins_ville'];
 $email=$_POST['ins_email'];
 $pass=md5($_POST['pass']);
	//requ�te permettant de v�rifier la pr�sence ou non d'un login d'utilisateur
   $req = "SELECT ins_email FROM client WHERE ins_email = '".$_POST["ins_email"]."' ";
   $req = mysql_query($req, $cnx) or die (mysql_error());
   $req = mysql_num_rows($req);//Renvoie le nombre de ligne pr�sent (0 = aucune donn�es pr�sentes)
   //Si le login de l'utilisateur n'est pas pr�sent dans la base de donn�es on l'ins�re
   if($req == 0)
   {
 
	//cr�ation de la requ�te SQL:
	$sql = "INSERT  INTO client(ins_nom, ins_prenom, ins_adresse, ins_CP, ins_ville, ins_email, pass)
            VALUES ('$nom', '$prenom','$adresse', '$cp','$ville','$email','$pass') " ;
 
	//ex�cution de la requ�te SQL:
	$requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
  
  
 
  //affichage d'un message de validation d'inscription
  if($requete)
  {
    echo"<script> alert ('Votre inscription a �t� prise en compte !');</script>";
    // et redirection vers la page d'accueil
    print ("<script language = \"JavaScript\">");
    print ("location.href = 'index.php';");
    print ("</script>");
  }
  else
  {
    echo "<script> alert ('Votre inscription a �chou� !');</script>" ;
  }
   mysql_close();  // on ferme la connexion 
  }
  //Sinon on affiche un message d'erreur
  else
  {
      echo"<script> alert('Email d�ja pr�sent dans la base de donn�es !');</script>";
	  // et redirection vers la page d'inscription
      print ("<script language = \"JavaScript\">");
      print ("location.href = 'Inscription.php';");
      print ("</script>");
  }
?>