<?php
	require_once("modele_connection.php");

    //Si l'utilisateur est connect�, on affiche le panier pour ajouter les produits
    if(isset($_SESSION['login']))
    {
        $panier="<img src='Images/ajout.png'/>";
    }

     //Sinon il ne peut pas ajouter de produits � son panier
     else{$panier="";}


    // Requ�te SQL : affichage de tout les produits
    $sql = 'SELECT * FROM article';
                    
    // Si une pr�f�rences est s�lectionn�e dans la liste d�roulante,alors on affiche les produits par cat�gorie     
    if(isset($_POST['preference']))
    {
        $categorie =$_POST['preference'];
        $sql = "SELECT * FROM article where pdt_categorie='$categorie'";
    }
            
        //Ex�cution de la requ�te et remplissage du curseur
        $lesProduits = Connection::getInstance()->query($sql);
                    
        //D�but du tableau contenant les produits
        echo '<center><table class="tabProduits" >';
                    
        //En t�te du tableau
        echo'<thead class="tabProduits"><td class="tabProduits">R�f�rence</td><td class="tabProduits">Description</td><td class="tabProduits">Tarifs</td><td class="tabProduits">Cat�gorie</td><td class="tabProduits">Produits</td><td class="tabProduits"></td></thead>';
                    
        // on fait une boucle qui va faire un tour pour chaque enregistrement et afficher toutes les donn�es de la table produits
        while($unProduit = $lesProduits->fetch(PDO::FETCH_OBJ))
        {   
            // Affichage des informations de l'enregistrement en cours
            //Si l'utilisateur n'est pas connect� il ne peut pas faire d'ajout au panier
                echo "
                     <tr class='tabProduits'>
                         <td class='tabProduits'>".$unProduit->pdt_ref."</td>
                         <td class='tabProduits'>".$unProduit->pdt_designation."</td>
                         <td class='tabProduits'>".$unProduit->pdt_prix." �</td>
                         <td class='tabProduits'>".$unProduit->pdt_categorie."</td>
                         <td class='tabProduits'><img src='Images/".$unProduit->pdt_ref.".jpg'></td>
                         <td class='tabProduits'>
                           <a href='panier.php?action=ajout&amp;pdt_ref=$unProduit->pdt_ref&amp;pdt_designation=$unProduit->pdt_designation&amp;pdt_prix=$unProduit->pdt_prix&amp;quantite=1'>
                              $panier
                           </a>
                         </td>
                     </tr>
                 ";
   
        }
                    
        //Fin du tableau contenant les produits
        echo '</table></center><br/><br/>';
?> 