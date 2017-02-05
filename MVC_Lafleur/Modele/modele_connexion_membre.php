<?php
	class ConnectionDAO{
		//attribut privé qui recevra une instance de la connexion
		private $cx;
		
		public function __construct(){
			require_once("Modele/modele_connexion_base.php");
			$this->cx = Connexion::getInstance();
		}

		public function existe()
		{
			//on récupère, via la méthode "post" les données envoyées
			$login= $_POST['login_connexion'];//identifiant de connexion
			$pass=md5($_POST['pass_connexion']);//mot de passe de connexion

			//requete SQL récupérant toutes les informations sur l'utilisateur
			$reqSQL="SELECT * FROM client WHERE ins_email=:login AND pass=:pass";
			$unLogin = Connexion::getInstance()->prepare($reqSQL);
			
			//j'associe les paramètres	
			$unLogin->bindValue(":login",$login,PDO::PARAM_STR);
			$unLogin->bindValue(":pass",$pass,PDO::PARAM_STR);	

			$unLogin->execute();

			//on stock dans une variable de session le nombre de lignes que renvoie la requête
			$nbLigne=0;
			if($uneLigne=$unLogin->fetch(PDO::FETCH_OBJ))
			{
				$existe=1;
			}

			return $existe;
	
		}
		
		public function connection()
		{
			//on récupère, via la méthode "post" les données envoyées
			$login= $_POST['login_connexion'];//identifiant de connexion
			$pass=md5($_POST['pass_connexion']);//mot de passe de connexion

			//requete SQL récupérant toutes les informations sur l'utilisateur
			$reqSQL="SELECT * FROM client WHERE ins_email=:login AND pass=:pass";
			$unLogin = Connexion::getInstance()->prepare($reqSQL);
			
			//j'associe les paramètres	
			$unLogin->bindValue(":login",$login,PDO::PARAM_STR);
			$unLogin->bindValue(":pass",$pass,PDO::PARAM_STR);	

			$unLogin->execute();

			//on stock dans une variable de session le nombre de lignes que renvoie la requête
			$nbLigne=0;
			if($uneLigne=$unLogin->fetch(PDO::FETCH_OBJ)){
				$nbLigne=1;
			}
			$_SESSION['userLog']=$nbLigne;
			
			if ($_SESSION['userLog']==1)//si la requete renvoie une ligne
			{
				$_SESSION['login']=$uneLigne->ins_email; //on stock l'identifiant dans une variable de session (C'EST CETTE VARIABLE QUI, SI ELLE EST NON VIDE, SIGNIFIE QUE L'ON EST CONNECTE)
				$_SESSION['nro_client']=$uneLigne->nro_client;
				//redirection vers la page index.php
				header("Location:index.php");
			}
		}
		
		public function read()
		{
			     // Requête SQL : affichage de tout les produits classé par date de commande
                 $req = "SELECT distinct nro_commande, date_commande FROM commande WHERE nro_client = {$_SESSION['nro_client']} ORDER BY date_commande ";
                 //Exécution de la requête
				 $curseur = $this->cx->query($req);
				 
				 return $curseur;
		}
	}
?>