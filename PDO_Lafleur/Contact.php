<!-- Développé par Mehdi MEGROUS-->
<?php
session_start();
?>
<HTML>
        <HEAD>
            <TITLE>Contact</TITLE>
        <!--Feuilles de style global-->
        <link rel = "stylesheet" type = "text/css" href = "style/style1.css">
		<!--Feuilles de style des tableaux-->
        <link rel = "stylesheet" type = "text/css" href = "style/formTabl.css">
		<!--Feuilles de style du menu-->
        <link rel = "stylesheet" type = "text/css" href = "style/underlinemenu.css">
            <!--Favicon-->
            <link rel="shortcut icon" href="Images/favicon.png"/>
            <!--Fonctions JavaScript-->
            <script type="text/javascript" src="JS/jquery.js"></script>
            <script type="text/javascript" src="JS/control_contact.js"></script>
        </HEAD>
    
    
        <BODY>
            <div id ='page'>
                <!--En-tête-->
                <?php include('header.php');?>
                    <!--Contenu de la page-->
                    <div id='content'>
                            <!-- Formulaire de contact-->
                                 
                                <img src="Images/contact.jpg"/>
                                <br>
                                <br> 
                                <!--Géolocalisation de la société-->
                                <div id='geolocalisation'>
                                     <h1>Où nous trouver ?</h1>
                                     <img src="Images/geolocalisation.jpg"/>
                                </div>

                                <div style='clear:both'></div>

                                <!--Horraires d'ouverture-->
                                <div id='ouverture'>
                                     <h1>Nos horraires&nbsp;</h1>
                                     Notre magasin est ouvert du lundi au vendredi de 9h à 12h et de 14h à 17h.<br/>
                                     Pour plus de renseignements :<br/>
                                     <img src="Images/telephone.gif"/>&nbsp;03-83-44-52-52<br/>
                                </div>
                                <br/>
                                <br/>

                                <div style='clear:both'></div>
                                <br/>
                                <br/>
                    </div>
                    <!--Pied de page-->
                    <?php include('footer.php');?>
            </div>
        </BODY>
</HTML>