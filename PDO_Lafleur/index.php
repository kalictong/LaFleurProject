<!--Développé par MEGROUS MEHDI!-->
<?php
session_start();
?>

<HTML>
    <HEAD>
        <TITLE>Accueil</TITLE>
        <!--Feuilles de style global-->
        <link rel = "stylesheet" type = "text/css" href = "style/style1.css">
		<!--Feuilles de style des tableaux-->
        <link rel = "stylesheet" type = "text/css" href = "style/formTabl.css">
		<!--Feuilles de style du menu-->
        <link rel = "stylesheet" type = "text/css" href = "style/underlinemenu.css">
		<!--Favicon-->
		<link rel="shortcut icon" href="Images/favicon.png" />
         <!--Fonctions JavaScript-->
         <script type="text/javascript" src="JS/jquery.js"></script>
	</HEAD>

    
    <BODY>
        <div id ='page'>
            <!--En-tête-->
            <?php include('header.php');?>
            <!--Contenu de la page-->
            <div id='content'>
                <center>
                    <img src="Images/accueil.jpg" name="accueil" onmouseover="accueil.src='Images/accueil2.jpg'" onmouseout="accueil.src='Images/accueil.jpg'">
					<img src="Images/ombre.png" width="800"/>
                </center>
                <br>
                <br>
            </div>
            <!--Pied de page-->
         <?php include('footer.php');?>
        </div>
  </BODY>
</HTML>