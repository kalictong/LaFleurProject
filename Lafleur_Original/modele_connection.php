<?php
	/**
	 * Classe d'acc�s aux donn�es.
	 * de type singleton
	 * qui utilise les services de la classe PDO
	 */
	 class Connection{
		 private static $monPdo;
		 
	/**
	 * Constructeur priv� vide
     */
		private function __construct(){
			Connection::$monPdo = null;
		}
	/**
	 * M�thode statique qui renvoie l'unique instance de Connection
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
				throw new Exception("Erreur � la connexion \n" . $e->getMessage());
			}
		}
		return Connection::$monPdo;
	}
	}
?>