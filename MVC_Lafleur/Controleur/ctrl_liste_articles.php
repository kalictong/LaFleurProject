<?php
		//j'indique que j'ai besoin du fichier model_table_messier
		//qui contient la classe TableMessier
		require ("Modele/modele_table_article.php");
		
		//J'instancie un objet TableMessier
		
		$ta= new ArticleDAO();
		
		if(!isset($_GET['cat'])){
			//Je récupère tous les objets
			$lesArticles=$ta->readAll();
		}
		else{
			$lesArticles=$ta->readAll($_POST['preference']);
		}

		
		//et je passe la main à la vue
		include("Vue/vue_liste_articles.php");
?>		