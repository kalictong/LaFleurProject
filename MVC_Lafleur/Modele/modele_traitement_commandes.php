<?php
class TraitementDAO{
	
//attribut privé qui recevra une instance de la connexion
		private $cx;
		
		public function __construct(){
			require_once("Modele/modele_connexion_base.php");
			$this->cx = Connexion::getInstance();
		}
		
		public function valid(){
		  $nrocommande=uniqid();//numéro de commande | uniqid() génère un identifiant unique
		  $date=date('y/m/d');//date du jour au format AAAA-MM-JJ
		  $client=$_SESSION['nro_client'];//numéro d'identification du client

		  //Booléen permettant de vérifier l'éxécution de la requête
		  $valid=true;
		  
		  //Insertion dans la table commande
		  $sql="INSERT INTO commande (nro_commande,date_commande,nro_client)
				VALUES (:nrocommande,:date,:client)";
		  //prepare la requete
		  $requete1 = $this->cx->prepare($sql);
		  
		  //jassocie les paramètre
		  $requete1->bindValue(":nrocommande",$nrocommande,PDO::PARAM_STR);
		  $requete1->bindValue(":date",$date,PDO::PARAM_STR);
		  $requete1->bindValue(":client",$client,PDO::PARAM_STR);
		  
		  //exécution de la requête SQL
		  $requete1->execute();
		  if(!$requete1){
			$valid=false;
		  }
		  
		  //Pour chaque référence dans le panier
		  foreach($_SESSION["panier"]["pdt_ref"] as $cle => $valeur){
			//création de la requête SQL (insertion des éléments dans la table ligne_commande)
			$sql2 = "INSERT  INTO ligne_commande(nro_commande, pdt_ref, prix_fixe, qte_commande)
					VALUES (:nrocommande, '{$_SESSION['panier']['pdt_ref'][$cle]}','{$_SESSION['panier']['pdt_prix'][$cle]}','{$_SESSION['panier']['quantite'][$cle]}') " ;
			
			//je prepare la requete
			$requete2 = $this->cx->prepare($sql2);

			//j'associe la requete
			$requete2->bindValue(":nrocommande",$nrocommande,PDO::PARAM_STR);
			
			//exécution de la requête SQL
			$requete2->execute();
			
			if(!$requete2){
				$valid=false;
			}
		  }
		  return $valid;
		}
 }
?>