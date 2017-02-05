<!--Développé par MEGROUS MEHDI!-->
<?php
session_start();
?>

<HTML>
    <HEAD>
        <TITLE>Accueil</TITLE>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
			
			<?php
					
				if(!isset($_GET['do'])){
			?>
					 <div id='content'>
						<center>
							<img src="Images/accueil.jpg" name="accueil" onmouseover="accueil.src='Images/accueil2.jpg'" onmouseout="accueil.src='Images/accueil.jpg'">
							<img src="Images/ombre.png" width="800"/>
						</center>
						<br>
						<br>
					</div>
			<?php		
				}
				else {
					
					switch($_GET['do']){

						case 'listeProduits':{
							//include("Controleurs/ctrl_liste_produits.php");
							include("Controleur/ctrl_liste_articles.php");
							break;
						}
						
						case 'detail':{
							include("Controleur/ctrl_detail_objet.php");
							break;
						}
						
						case 'inscription':{

							include("Controleur/ctrl_inscription.php");
							break;
						}
						
						case 'connectionMembre':{

							include("Controleur/ctrl_connection_membre.php");
							break;
						}
						
						case 'contact':{
							
							include("Controleur/ctrl_contact.php");
							break;
						}
						
						case 'deconnection':{
							include("Controleur/ctrl_deconnection.php");
							break;
						}
						
						case 'panier':{
							include("Controleur/ctrl_fonction_panier.php");
							break;
						}
						
						case 'traitementCommandes':{
							include("Controleur/ctrl_traitement_commandes.php");
							break;
						}
						
						case 'facture':{
							include("Controleur/ctrl_traitement_facture.php");
							break;
						}

					}
				}
			?>			
           
            <!--Pied de page-->
         <?php include('footer.php');?>
        </div>
  </BODY>
</HTML>