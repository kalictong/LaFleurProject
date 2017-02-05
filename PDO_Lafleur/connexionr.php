<?php
// On démarre la session avant d'écrire du code HTML
session_start();

//on récupère, via la méthode "post" les données envoyées
$login= $_POST['login_connexion'];//identifiant de connexion
$pass=md5($_POST['pass_connexion']);//mot de passe de connexion


//variables de connexion
$adrConnex="localhost";
$idConnex="root";
$mdpConnex="";
$bdd="LAFLEUR_BDD";

//requete SQL récupérant toutes les informations sur l'utilisateur
$reqSQL="SELECT * FROM client WHERE ins_email='$login' AND pass='$pass'";

//on se connecte à mySQL
$cnx=mysql_connect($adrConnex, $idConnex, $mdpConnex) or die('Impossible de ce connecter à MySQL.');

if($cnx)  //si la connexion à MySQL fonctionne, on se connecte à la base de données
{
    $db=mysql_select_db($bdd) or die('Impossible de se connecter à la base de données.');

    if($db) //si la connexion à la BDD fonctionne, on éxécute la requête
    {
        $req = mysql_query($reqSQL, $cnx) or die("Impossible d'exécuter la requête.");
        
        //on stock dans une variable de session le nombre de lignes que renvoie la requête
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