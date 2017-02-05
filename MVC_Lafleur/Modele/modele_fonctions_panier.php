<?php
class PanierDAO{
	
////////////////////////////////////////////////////////////////////////
//////////////////////Fonction création du panier///////////////////////
////////////////////////////////////////////////////////////////////////
function creationPanier()
{
   //Si le panier n'existe pas alors on le crée
   if (!isset($_SESSION['panier']))
   {
     $_SESSION['panier']=array();
     $_SESSION['panier']['pdt_ref'] = array();
     $_SESSION['panier']['quantite'] = array();
     $_SESSION['panier']['pdt_prix'] = array();
     $_SESSION['panier']['pdt_designation'] = array();
   }
   return true;
}

////////////////////////////////////////////////////////////////////////
//////////////////////Fonction Ajouter un article/////////////////////////
////////////////////////////////////////////////////////////////////////
function ajouterArticle($pdt_ref,$pdt_designation,$pdt_prix,$quantite,$creationPanier)
{
  //Si le panier existe
  if ($creationPanier)
  {
     //array_search recherche dans le tableau la clé associée à une valeur
     $positionProduit = array_search($pdt_ref,  $_SESSION['panier']['pdt_ref']);
     
     //Si le produit existe déjà on ajoute seulement la quantité

     if ($positionProduit !== false)
     {
       $_SESSION['panier']['quantite'][$positionProduit] += $quantite ;
     }

     else
     {
      //Sinon on ajoute le produit
      //array_push permet d'ajouter une valeur après la dernière ligne d'un tableau
      array_push( $_SESSION['panier']['pdt_ref'],$pdt_ref);
      array_push( $_SESSION['panier']['pdt_designation'],$pdt_designation);
      array_push( $_SESSION['panier']['quantite'],$quantite);
      array_push( $_SESSION['panier']['pdt_prix'],$pdt_prix);
     }
   }
   else
   echo "Un problème est survenu lors de l'ajout au panier.";
}

////////////////////////////////////////////////////////////////////////
//////////////////////Fonction Supprimer un article////////////////////////
////////////////////////////////////////////////////////////////////////
function supprimerArticle($pdt_ref,$creationPanier)
{
   //Si le panier existe
   if ($creationPanier)
   {
     //Création d'un panier temporaire
     $tmp=array();
     $tmp['pdt_ref'] = array();
     $tmp['quantite'] = array();
     $tmp['pdt_prix'] = array();
     $tmp['pdt_designation'] = array();
     // Parcours de tout les éléments du tableau
     for($i = 0; $i < count($_SESSION['panier']['pdt_ref']); $i++)
       {
         if ($_SESSION['panier']['pdt_ref'][$i] !== $pdt_ref)
         {
            array_push( $tmp['pdt_ref'],$_SESSION['panier']['pdt_ref'][$i]);
            array_push( $tmp['quantite'],$_SESSION['panier']['quantite'][$i]);
            array_push( $tmp['pdt_prix'],$_SESSION['panier']['pdt_prix'][$i]);
            array_push( $tmp['pdt_designation'],$_SESSION['panier']['pdt_designation'][$i]);
         }

       }
       //On remplace le panier en session par notre panier temporaire à jour
       $_SESSION['panier'] =  $tmp;
       //On efface notre panier temporaire
       unset($tmp);
   }
   else
   echo "Un problème est survenu lors de la supression de l'article.";
}


/////////////////////////////////////////////////////////////////////////
//////////////////////Fonction modifier quantite d' un article////////////////
////////////////////////////////////////////////////////////////////////
function modifierQTeArticle($pdt_ref,$quantite,$creationPanier)
{
   //Si le panier éxiste
   if ($creationPanier)
   {
     //Si la quantité est positive on modifie sinon on supprime l'article
     if ($quantite > 0)
     {
       //Recharche du produit dans le panier
       $positionProduit = array_search($pdt_ref,  $_SESSION['panier']['pdt_ref']);

       if ($positionProduit !== false)
       {
         $_SESSION['panier']['quantite'][$positionProduit] = $quantite ;
       }
     }
     else
     supprimerArticle($pdt_ref);
   }
   else
   echo "Un problème est survenu lors de la modification de l'article";
}

////////////////////////////////////////////////////////////////////////
//////////////////////Fonction Montant global/////////////////////////////
////////////////////////////////////////////////////////////////////////
function MontantGlobal()
{  
   $total=0;
   //On parcours le contenu du panier
   for($i = 0; $i < count($_SESSION['panier']['pdt_ref']); $i++)
   {
      //+= addition de deux valeurs et stocke le résultat dans la variable
      $total += ($_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['pdt_prix'][$i]);
   }
   //Retourne le prix total
   if($total < 100){
		$total+=9.99;
   }
   return $total;
}


////////////////////////////////////////////////////////////////////////
//////////////////////Fonction Compter Article////////////////////////////
////////////////////////////////////////////////////////////////////////
function compterArticles()
{
   // si le panier n'est pas vide
   if (isset($_SESSION['panier']))
   //on compte le nombre de référence dans le panier et on retourne ce résultat 
   return count($_SESSION['panier']['pdt_ref']);
   //sinon on retourne 0
   else
   return 0;

}

////////////////////////////////////////////////////////////////////////
//////////////////////Fonction Supprimer Panier///////////////////////////
////////////////////////////////////////////////////////////////////////
function supprimePanier()
{
   //détruit la variable de session panier
   unset($_SESSION['panier']);
}
}
?>