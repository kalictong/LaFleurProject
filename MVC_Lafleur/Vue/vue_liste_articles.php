 
 <div id ='page'>

        <!--Contenu de la page-->
        <div id='content'>
            <center>
                <img src="Images/produits.jpg"/>
            </center>
            <br>
            <br>
            <center>
                Sélectionnez votre catégorie de produit :
                <!--Formulaire de sélection de la catégorie-->
                <form method="post" action="index.php?do=listeProduits&cat=1">
                    <select name = "preference">
                        <option value ="bul">Bulbes </option>
                        <option value="ros">Rosiers</option>
                        <option value="mas">Plantes Massif</option>
						<option value="biere">Bière Massive</option>
                    </select>
                    <input type="submit" value="Afficher">
                </form>
            </center>  
			<!--Traitement de l'inclusion des produits-->


	<?php
	//Si l'utilisateur est connecté, on affiche le panier pour ajouter les produits
	$panier = null;
	if(isset($_SESSION['login']))
	{
		$panier="<img src='Images/ajout.png'/>";
	}
	
	 echo '<center><table class="tabProduits" >';
                    
        //En tête du tableau
        echo'<thead class="tabProduits"><td class="tabProduits">Référence</td><td class="tabProduits">Description</td><td class="tabProduits">Tarifs</td><td class="tabProduits">Catégorie</td><td class="tabProduits">Produits</td><td class="tabProduits"></td></thead>';
                    
        // on fait une boucle qui va faire un tour pour chaque enregistrement et afficher toutes les données de la table produits
		while($unArticle=$lesArticles->fetch(PDO::FETCH_OBJ))
		{ 

            // Affichage des informations de l'enregistrement en cours
            //Si l'utilisateur n'est pas connecté il ne peut pas faire d'ajout au panier
                echo "
                     <tr class='tabProduits'>
                         <td class='tabProduits'>".$unArticle->pdt_ref."</td>
                         <td class='tabProduits'>".$unArticle->pdt_designation."</td>
                         <td class='tabProduits'>".$unArticle->pdt_prix." €</td>
                         <td class='tabProduits'>".$unArticle->pdt_categorie."</td>
                         <td class='tabProduits'><img src='Images/".$unArticle->pdt_ref.".jpg'></td>
                         <td class='tabProduits'>
                           <a href='index.php?do=panier&action=ajout&pdt_ref=$unArticle->pdt_ref&pdt_designation=$unArticle->pdt_designation&pdt_prix=$unArticle->pdt_prix&quantite=1'>
								$panier
						   </a>
                         </td>
                        
                     </tr>
                    
                 ";     
        }
                    
        //Fin du tableau contenant les produits
        echo '</table></center><br/><br/>';
		
		//Si la variable messConf n'est pas vide on affiche un message de confirmation
		if(isset($_SESSION['messConf']))
		{
			echo "<div class='messConf'>".$_SESSION['messConf']."</div>";
			unset($_SESSION['messConf']);
		}
	?>
	
	</div>

</div>	
