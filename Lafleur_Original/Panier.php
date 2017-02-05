<!-- Développé par Mehdi MEGROUS-->
<?php
    session_start();
    // fonctions utilisées pour le panier
    include("fonctions-panier.php");
    
//On initialise erreur à false
$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:(isset($_GET['action'])? $_GET['action']:null ));

if($action !== null)
{  //si l'action n'est pas ajout, suppression ou refresh alors erreur = vrai 
	if(!in_array($action,array('ajout', 'suppression', 'delete', 'refresh'))){
		$erreur=true;
	}

   //récuperation des variables en POST ou GET
	$pdt_ref = (isset($_POST['pdt_ref'])? $_POST['pdt_ref']:  (isset($_GET['pdt_ref'])? $_GET['pdt_ref']:null )) ;
	$pdt_designation = (isset($_POST['pdt_designation'])? $_POST['pdt_designation']:  (isset($_GET['pdt_designation'])? $_GET['pdt_designation']:null )) ;
	$pdt_prix = (isset($_POST['pdt_prix'])? $_POST['pdt_prix']:  (isset($_GET['pdt_prix'])? $_GET['pdt_prix']:null )) ;
	$quantite = (isset($_POST['quantite'])? $_POST['quantite']:  (isset($_GET['quantite'])? $_GET['quantite']:null )) ;

   //Suppression des espaces verticaux
   $pdt_ref = preg_replace('#\v#', '',$pdt_ref);
   //On verifie que $pdt_prix soit un réel
   $pdt_prix = floatval($pdt_prix);
   
   //Redirection vers la page panier.php afin d'éviter les problèmes d'actualisation de la page lors de l'ajout d'un produit
   if($action=='ajout')
   {
		$_SESSION['messConf']="Votre article a bien été ajouté au panier.";
		header("Location:NosProduits.php");
   }
   //A ne surtout pas faire sinon on écrase le $_post !!
   // else {
		// header("Location:Panier.php");
	// }

}
//si il n'y a pas d'erreur
if (!$erreur){
   //switch éxécute chaque action dans l'ordre et on interrompt le traitement lorque l'action correspond au choix éffectué
   switch($action){
      Case "ajout":
			ajouterArticle($pdt_ref,$pdt_designation,$pdt_prix,$quantite);
			break;

      Case "suppression":
			supprimerArticle($pdt_ref);
			break;

      Case "delete":
			supprimePanier();
			break;
	  
      Case "refresh":
			foreach($_POST['panier'] as $cle=>$valeur){
				modifierQTeArticle($cle,$valeur);
			}
			break;
      break;	  

      Default:
      break;
   }
}

?>
<HTML>
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"/>
        <link rel="shortcut icon" href="Images/favicon.png" />
        <TITLE>Panier</TITLE>
        <!--Feuilles de style-->
        <link rel = "stylesheet" type = "text/css" href = "style/style1.css">
        <link rel = "stylesheet" type = "text/css" href = "style/underlinemenu.css">
        <link rel = "stylesheet" type = "text/css" href = "style/formTabl.css">
    </HEAD>
    
  <BODY>
    <div id ='page'>
        <!--En-tête-->
        <?php include('header.php');?>
        
        <!--Contenu de la page-->
            <div id='content'>
                <center><img src="Images/panier.jpg"/></center>
                <br>
                <form method="post" action="panier.php">
                    <!--Début table panier-->


                    <table class="tabpanier" cellspacing="0">
                        <!--En tête de la table panier-->
                        <tr class="entete">
                            <td>Produit</td>
                            <td>Description</td>
                            <td>Prix TTC</td>
                            <td>Quantité</td>
                            <td>Supprimer</td>
                        </tr>
                    

                        <?php
                            // Si le panier existe
                            if (creationPanier())
                            {	//On compte le nombre de références dans le panier et on le stock dans une variable
                                $nbArticles=count($_SESSION['panier']['pdt_ref']);
								//si le nombre d'article est inférieur ou égale à 0 alors on affiche que le panier est vide
                                if ($nbArticles <= 0)
                                  
                                   echo "<tr><td colspan='5'>Votre panier est vide </td></tr>";
                                //sinon tout les produits du panier on affiche la référence, la description, le prix et la quantité  
                                else
                                {
                                    for ($i=0 ;$i < $nbArticles ; $i++)
                                    {
                                        echo "<tr>";
                                        echo "<td><img src='Images/".$_SESSION['panier']['pdt_ref'][$i].".jpg' width='50px' /></ td>"; //référence du produit
                                        echo "<td>".$_SESSION['panier']['pdt_designation'][$i]."</td>"; //designation du produit
                                        echo "<td>".$_SESSION['panier']['pdt_prix'][$i]." €</td>"; //affichage du prix du produit
										
                                        echo "<td><input type='text' name='panier[".$_SESSION['panier']['pdt_ref'][$i]."]' id='quantite' value='".$_SESSION['panier']['quantite'][$i]."'></td>"; //quantité du produit sélectionné
										
                                        //Permet la suppression d'un article du panier
										echo "
                                             <td>
                                                 <a href='panier.php?action=suppression&pdt_ref=".rawurlencode($_SESSION['panier']['pdt_ref'][$i])."'><img src='Images/supprimer.png'/></a>
                                             </td>
                                        ";
                                        echo "</tr>";
                                    }

                                    echo "<tr><td colspan=\"2\"> </td>";
                                    echo "<tr><td colspan=\"7\">";
									//Frais de port fixe
									if(MontantGlobal()>109.89){
										echo" Frais de port : Offerts !";
									}
									else{
										echo" Frais de port : 9,99 €";										
									}
                                    echo"</td></tr>";
									
                                    echo"<tr><td colspan=\"6\">";
                                    //Affichage du montant total
                                    echo "<h2>Total : ".MontantGlobal()." €</h2>";
                                    echo "</td></tr>";
									//champ caché qui permettra de passer l'action refresh en post sur clic de recalculer
                                    echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
                                    echo '';
            
                                }
 
                            }
                            
                            echo"</table>";
							echo "<input type='submit' name='recalculer' value='Recalculer'>";
							echo"</form>";
                            //Si le nombre d'article est supérieur à 0 alors on affiche le bouton pour passer la commande
                            if ($nbArticles > 0)
                            {
								echo"<form name='commande' action='traitement_commande.php' method='POST'>";
								echo "<input type='submit' name='commander' value='Passer la commande'>";
								echo"</form>";
                            }
							
                        ?>
                <br/>
                <a class='panier' href="NosProduits.php">Retour à la liste des produits</a>
            </div>
            
        <!--Pied de page-->
        <?php include('footer.php');?>
    </div>
  </BODY>
</HTML>