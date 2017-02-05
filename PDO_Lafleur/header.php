<!-------------- AFFICHAGE DU FORMULAIRE DE CONNEXION-------------->
<div id='header'>
    <?php

        //si l'utilisateur n'est pas connect� on le signal � l'utilisateur( !isset =si la variable n'est pas affect�e )
        if(!isset($_SESSION['login']))
        {
            echo "&nbsp;Vous n'�tes pas connect�(e) ! ";
        }
		//Sinon on affiche son identifiant et un lien de d�connexion
        else
        {
            echo '<img src="Images/membres.png"/>';
            echo "<strong>{$_SESSION['login']}</strong>";
            echo " &nbsp;<a href='deconnexion.php'><img src='Images/deconnexion.png' title='D�connexion'/></a>";
        }
    ?> 
</div>

<!-------------- AFFICHAGE DU MENU -------------->
<?php

    //Si l'utilisateur n'est pas connect� on affiche le menu complet
    if(!isset($_SESSION['login']))
    {
		include('menu.php');
    }
    //Sinon l'utilisateur est connect�, on supprime l'acc�s a la page inscription
else
{

?>
    <center>
        <div id='menu'> 
            <div id='underlinemenu'>
                <ul>
                    <li><a href="index.php" title="Accueil">&nbsp;Accueil&nbsp;</a></li>
                    <li><a href="NosProduits.php" title="Notre gamme de produits">&nbsp;Nos Produits&nbsp;</a></li>
                    <li><a href="Panier.php?r=0" title="Mon panier d'achat">&nbsp;Mon Panier&nbsp;</a></li>
                     <li><a href="membre.php" title="Votre Espace membre">&nbsp;Espace membre&nbsp;</a></li>
                    <li><a href="Contact.php" title="Contactez-nous">&nbsp;Contact&nbsp;</a></li>  
                </ul>   
            </div>
        </div>
</center>
<?php
}
?>