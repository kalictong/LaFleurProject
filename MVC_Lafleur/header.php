<!-------------- AFFICHAGE DU FORMULAIRE DE CONNEXION-------------->
<div id='header'>
    <?php

        //si l'utilisateur n'est pas connecté on le signal à l'utilisateur( !isset =si la variable n'est pas affectée )
        if(!isset($_SESSION['login']))
        {
            echo "&nbsp;Vous n'êtes pas connecté(e) ! ";
        }
		//Sinon on affiche son identifiant et un lien de déconnexion
        else
        {
            echo '<img src="Images/membres.png"/>';
            echo "<strong>{$_SESSION['login']}</strong>";
            echo " &nbsp;<a href='index.php?do=deconnection'><img src='Images/deconnexion.png' title='Déconnexion'/></a>";
        }
    ?> 
</div>

<!-------------- AFFICHAGE DU MENU -------------->
<?php

    //Si l'utilisateur n'est pas connecté on affiche le menu complet
    if(!isset($_SESSION['login']))
    {
		include('menu.php');
    }
    //Sinon l'utilisateur est connecté, on supprime l'accès a la page inscription
	else
	{

	?>
		<center>
			<div id='menu'> 
				<div id='underlinemenu'>
					<ul>
						<li><a href="index.php" title="Accueil">&nbsp;Accueil&nbsp;</a></li>
						<li><a href="index.php?do=listeProduits" title="Notre gamme de produits">&nbsp;Nos Produits&nbsp;</a></li>
						<li><a href="index.php?do=panier" title="Mon panier d'achat">&nbsp;Mon Panier&nbsp;</a></li>
						 <li><a href="index.php?do=connectionMembre" title="Votre Espace membre">&nbsp;Espace membre&nbsp;</a></li>
						<li><a href="index.php?do=contact" title="Contactez-nous">&nbsp;Contact&nbsp;</a></li>  
					</ul>   
				</div>
			</div>
	</center>
	<?php
	}
?>