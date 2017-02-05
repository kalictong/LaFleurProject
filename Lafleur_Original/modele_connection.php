<?php
	/**
	 * Classe d'accès aux données.
	 * de type singleton
	 * qui utilise les services de la classe PDO
	 */
	 class Connection{
		 private static $monPdo;
		 
	/**
	 * Constructeur privé vide
     */
		private function __construct(){
			Connection::$monPdo = null;
		}
	/**
	 * Méthode statique qui renvoie l'unique instance de Connection
	**/
	public static function getInstance(){
		if( Connection::$monPdo == null){
			try {
				$serveur='mysql:host=localhost';
				$bdd='dbname=lafleur_bdd';
				$user='root';
				$mdp='';
				Connection::$monPdo = new PDO($serveur.';'.$bdd, $user, $mdp);
				Connection::$monPdo->query("SET CHARACTER SET utf8");
			} catch (PDOException $e) {
				throw new Exception("Erreur à la connexion \n" . $e->getMessage());
			}
		}
		return Connection::$monPdo;
	}
	}
?>