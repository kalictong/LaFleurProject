<?php
class PanierDAO{
	
////////////////////////////////////////////////////////////////////////
//////////////////////Fonction cr�ation du panier///////////////////////
////////////////////////////////////////////////////////////////////////
function creationPanier()
{
   //Si le panier n'existe pas alors on le cr�e
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
     //array_search recherche dans le tableau la cl� associ�e � une valeur
     $positionProduit = array_search($pdt_ref,  $_SESSION['panier']['pdt_ref']);
     
     //Si le produit existe d�j� on ajoute seulement la quantit�

     if ($positionProduit !== false)
     {
       $_SESSION['panier']['quantite'][$positionProduit] += $quantite ;
     }

     else
     {
      //Sinon on ajoute le produit
      //array_push permet d'ajouter une valeur apr�s la derni�re ligne d'un tableau
      array_push( $_SESSION['panier']['pdt_ref'],$pdt_ref);
      array_push( $_SESSION['panier']['pdt_designation'],$pdt_designation);
      array_push( $_SESSION['panier']['quantite'],$quantite);
      array_push( $_SESSION['panier']['pdt_prix'],$pdt_prix);
     }
   }
   else
   echo "Un probl�me est survenu lors de l'ajout au panier.";
}

////////////////////////////////////////////////////////////////////////
//////////////////////Fonction Supprimer un article////////////////////////
////////////////////////////////////////////////////////////////////////
function supprimerArticle($pdt_ref,$creationPanier)
{
   //Si le panier existe
   if ($creationPanier)
   {
     //Cr�ation d'un panier temporaire
     $tmp=array();
     $tmp['pdt_ref'] = array();
     $tmp['quantite'] = array();
     $tmp['pdt_prix'] = array();
     $tmp['pdt_designation'] = array();
     // Parcours de tout les �l�ments du tableau
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
       //On remplace le panier en session par notre panier temporaire � jour
       $_SESSION['panier'] =  $tmp;
       //On efface notre panier temporaire
       unset($tmp);
   }
   else
   echo "Un probl�me est survenu lors de la supression de l'article.";
}


/////////////////////////////////////////////////////////////////////////
//////////////////////Fonction modifier quantite d' un article////////////////
////////////////////////////////////////////////////////////////////////
function modifierQTeArticle($pdt_ref,$quantite,$creationPanier)
{
   //Si le panier �xiste
   if ($creationPanier)
   {
     //Si la quantit� est positive on modifie sinon on supprime l'article
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
   echo "Un probl�me est survenu lors de la modification de l'article";
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
      //+= addition de deux valeurs et stocke le r�sultat dans la variable
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
   //on compte le nombre de r�f�rence dans le panier et on retourne ce r�sultat 
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
   //d�truit la variable de session panier
   unset($_SESSION['panier']);
}
}
?>