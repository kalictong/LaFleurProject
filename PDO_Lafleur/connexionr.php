<?php
// On d�marre la session avant d'�crire du code HTML
session_start();

//on r�cup�re, via la m�thode "post" les donn�es envoy�es
$login= $_POST['login_connexion'];//identifiant de connexion
$pass=md5($_POST['pass_connexion']);//mot de passe de connexion


//variables de connexion
$adrConnex="localhost";
$idConnex="root";
$mdpConnex="";
$bdd="LAFLEUR_BDD";

//requete SQL r�cup�rant toutes les informations sur l'utilisateur
$reqSQL="SELECT * FROM client WHERE ins_email='$login' AND pass='$pass'";

//on se connecte � mySQL
$cnx=mysql_connect($adrConnex, $idConnex, $mdpConnex) or die('Impossible de ce connecter � MySQL.');

if($cnx)  //si la connexion � MySQL fonctionne, on se connecte � la base de donn�es
{
    $db=mysql_select_db($bdd) or die('Impossible de se connecter � la base de donn�es.');

    if($db) //si la connexion � la BDD fonctionne, on �x�cute la requ�te
    {
        $req = mysql_query($reqSQL, $cnx) or die("Impossible d'ex�cuter la requ�te.");
        
        //on stock dans une variable de session le nombre de lignes que renvoie la requ�te
        $_SESSION['userLog']=mysql_num_rows($req);

        $req=mysql_fetch_array($req);

        if ($_SESSION['userLog']==1)//si la requete renvoie une ligne
        {
            $_SESSION['login']=$req["ins_email"]; //on stock l'identifiant dans une variable de session (C'EST CETTE VARIABLE QUI, SI ELLE EST NON VIDE, SIGNIFIE QUE L'ON EST CONNECTE)
            $_SESSION['nro_client']=$req["nro_client"];
			//redirection vers la page index.php
            header("Location:index.php");
        }else //si la requete ne renvoie pas de ligne
            {
                $_SESSION['errorLog']=true;
                //si erreur=true(mot de passe ou login incorrect alors on affiche un message d'erreur)
                echo"<script> alert ('Login ou Mot De Passe Incorrect !');</script>";
                // et redirection vers la page d'accueil
                print ("<script language = \"JavaScript\">");
                print ("location.href = 'index.php';");
                print ("</script>");
            } 
    }
}
mysql_close(); // on ferme MySQL
?>