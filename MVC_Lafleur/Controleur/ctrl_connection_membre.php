<?php
			//j'indique que j'ai besoin du fichier modele_table_article
			//qui contient la classe table membre
			require ("Modele/modele_connexion_membre.php");
			
			//J'instancie un objet Table membre
			$ta= new ConnectionDAO();
			
			if(isset($_SESSION['login']))
			{
				 $lesCommandes=$ta->read();
				 include("Vue/vue_connection_membre.php");
			}
			else
			{
				if(isset($_GET['mem']))
				{
					$Existe=$ta->existe();
					$login= $_POST['login_connexion'];//identifiant de connexion
					if($Existe==1)
					{
						$uneLigne=$ta->connection();
					}
					else //si la requete ne renvoie pas de ligne
					{
						//si erreur=true(mot de passe ou login incorrect alors on affiche un message d'erreur)
						echo"<script> alert ('Login ou Mot De Passe Incorrect !');</script>";
						// et redirection vers la page d'accueil
						print ("<script language = \"JavaScript\">");
						print ("location.href = 'index.php';");
						print ("</script>");
					}
				}
				else
				{
					include("Vue/vue_connection_membre.php");
				}
			}	
?>