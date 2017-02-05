<?php
	class ArticleDAO{
		//attribut privé qui recevra une instance de la connexion
		private $cx;
		
		public function __construct(){
			require_once("Modele/modele_connexion_base.php");
			$this->cx = Connexion::getInstance();
		}
		
		//retourne un curseur contenant tous les objets
		public function readAll($cat=null){
			if($cat!==null){
				$req = "SELECT pdt_ref, pdt_designation, pdt_prix, pdt_categorie FROM article where pdt_categorie='$cat' ORDER BY pdt_ref";
			}
			else{
				$req = "SELECT pdt_ref, pdt_designation, pdt_prix, pdt_categorie FROM article ORDER BY pdt_ref";
			}
			
			$curseur = $this->cx->query($req);
			return $curseur;
		}
		
		//retourne un curseur contenant l'objet associé à l'identidfiant 
		//passé en paramètre 
		//on utilise ici la technique des requêtes préparées qui permettent
		//d'éviter les injonctions SQL
		public function findByID($idObjet){
			//je conçois ma requête sql 
			$req = "SELECT pdt_ref, pdt_designation, pdt_prix, pdt_categorie FROM article WHERE numero = :id";
		
		//je prépare mes requêtes
		$prep = $this->cx->prepare($req);
		
		//j'associe les paramètres 
		$prep->bindValue(':id',$idObjet,PDO::PARAM_STR);
		
		//j'exécute
		$prep->execute();
		
		//je remplie le curseur
		$curseur = $prep->fetchObjet();
		return $curseur;
		}
	}
?>