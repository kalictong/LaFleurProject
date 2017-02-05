<!-- Développé par Mehdi MEGROUS-->
<?php
session_start();
?>

<HTML>
    <HEAD>
        <TITLE>Nos Produits</TITLE>
        <!--Feuilles de style-->
        <link rel = "stylesheet" type = "text/css" href = "style/style1.css">
        <link rel = "stylesheet" type = "text/css" href = "style/underlinemenu.css">
        <link rel = "stylesheet" type = "text/css" href = "style/formTabl.css">
        <!--Favicon-->
        <link rel="shortcut icon" href="Images/favicon.png" />
        <script type="text/javascript" src="JS/jquery.js"></script>
        <script type="text/javascript">$(document).ready(function(){$("div.messConf").delay(2000).fadeOut();});</script>
    </HEAD>
    
    
  <BODY>
    <div id ='page'>
        <!--En-tête-->
        <?php include('header.php');?>
        <!--Contenu de la page-->
        <div id='content'>
            <center>
                <img src="Images/produits.jpg"/>
            </center>
            <br>
            <br>
            <center>
                Sélectionnez votre catégorie de produit :
                <!--Formulaire de sélection de la catégorie-->
                <form method="post" action="NosProduits.php">
                    <select name = "preference">
                        <option value ="bul">Bulbes </option>
                        <option value="ros">Rosiers</option>
                        <option value="mas">Plantes Massif</option>
                    </select>
                    <input type="submit" value="Afficher">
                </form>
            </center>  
			<!--Traitement de l'inclusion des produits-->
            <?php include('InsertProduits.php');?>
        </div>
        <!--Pied de page-->
        <?php include('footer.php');?>
    </div>

	
<?php
//Si la variable messConf n'est pas vide on affiche un message de confirmation
if(isset($_SESSION['messConf']))
{
    echo "<div class='messConf'>".$_SESSION['messConf']."</div>";
    unset($_SESSION['messConf']);
}

?>
  </BODY>

</HTML>