<?php
//r�cup�re toutes les variables de sessions d�clar�es auparavant
session_start();

//d�truit toutes les varibles de session -> deconnexion
session_destroy();

//redirection vers la page d'accueil
header("Location:index.php");
?>