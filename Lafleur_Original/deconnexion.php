<?php
//récupère toutes les variables de sessions déclarées auparavant
session_start();

//détruit toutes les varibles de session -> deconnexion
session_destroy();

//redirection vers la page d'accueil
header("Location:index.php");
?>