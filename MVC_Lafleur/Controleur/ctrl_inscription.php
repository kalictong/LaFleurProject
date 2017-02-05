<?php
		
		if(isset($_GET['ins'])){
			
			//j'indique que j'ai besoin du fichier model_table_messier
			//qui contient la classe TableMessier
			require ("Modele/modele_inscription.php");
			
			//J'instancie un objet TableMessier
			
			$ta= new InscriptionDAO();			
			//Je récupère tous les objets
			$reussi=$ta->create();
			
			if($reussi){
				echo"<script> alert ('Votre inscription a été prise en compte !');</script>";
				// et redirection vers la page d'accueil
				print ("<script language = \"JavaScript\">");
				print ("location.href = 'index.php';");
				print ("</script>");
			}else{
				echo"<script> alert('Email déja présent dans la base de données !');</script>";
				// et redirection vers la page d'inscription
				print ("<script language = \"JavaScript\">");
				print ("location.href = 'index.php?do=inscription';");
				print ("</script>");				
			}
			
		}
		else{
			//et je passe la main à la vue
			include("Vue/vue_inscription.php");
		}

		

?>		