<?php
	// On démarre la session avant d'écrire du code HTML
	session_start();

	//on récupère, via la méthode "post" les données envoyées
	$login= $_POST['login_connexion'];//identifiant de connexion
	$pass=md5($_POST['pass_connexion']);//mot de passe de connexion

	require_once("connexionBDD.php");


	//requete SQL récupérant toutes les informations sur l'utilisateur
	$reqSQL="SELECT * FROM client WHERE ins_email=:login AND pass=:pass";
	$unLogin = Connexion::getInstance()->prepare($reqSQL);
	
	//j'associe les paramètres	
	$unLogin->bindValue(":login",$login,PDO::PARAM_STR);
	$unLogin->bindValue(":pass",$pass,PDO::PARAM_STR);	

	$unLogin->execute();

	//on stock dans une variable de session le nombre de lignes que renvoie la requête
	$nbLigne=0;
	if($uneLigne=$unLogin->fetch(PDO::FETCH_OBJ)){
		$nbLigne=1;
	}
	$_SESSION['userLog']=$nbLigne;
	
	if ($_SESSION['userLog']==1)//si la requete renvoie une ligne
	{
		$_SESSION['login']=$uneLigne->ins_email; //on stock l'identifiant dans une variable de session (C'EST CETTE VARIABLE QUI, SI ELLE EST NON VIDE, SIGNIFIE QUE L'ON EST CONNECTE)
		$_SESSION['nro_client']=$uneLigne->nro_client;
		//redirection vers la page index.php
		header("Location:../index.php");
	}
	else //si la requete ne renvoie pas de ligne
	{
		$_SESSION['errorLog']=true;
		//si erreur=true(mot de passe ou login incorrect alors on affiche un message d'erreur)
		echo"<script> alert ('Login ou Mot De Passe Incorrect !');</script>";
		// et redirection vers la page d'accueil
		print ("<script language = \"JavaScript\">");
		print ("location.href = '../index.php';");
		print ("</script>");
	}

?>