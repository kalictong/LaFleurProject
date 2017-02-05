﻿<!-- Développé par Mehdi MEGROUS-->
<HTML>
    <HEAD>
        <TITLE>Espace membre</TITLE>
        <!--Feuilles de style-->
        <link rel = "stylesheet" type = "text/css" href = "style/style1.css">
        <link rel = "stylesheet" type = "text/css" href = "style/underlinemenu.css">
        <link rel = "stylesheet" type = "text/css" href = "style/formTabl.css">

    </HEAD>
    
    
  <BODY>
    <div id ='page'>
        <!--Contenu de la page-->
        <div id='content'>
            <center>
                <img src="Images/membre.png"/>
            
				<?php
					//si l'utilisateur n'est pas connecté on affiche un formulaire de connexion 
					if(!isset($_SESSION['login']))
					{
				?>

                </br>
                <form action="index.php?do=connectionMembre&mem=true" method="POST">
                    <table class="tabConnex">
                    <h1>Déja membre?<br/>Identifiez-vous !</h1>
                        <tr>
                            <td>E-mail</td> <td><input type="text" name="login_connexion"></td>
                        </tr>
                        <tr>
                            <td>Mot de passe :</td> <td><input type="password" name="pass_connexion"></td>
                        </tr>
                        <tr>
                            <td><input type="reset" value="Annuler" id="annuler"></td><td><input type="submit" value="Connexion" id="connexion"></td>
                        </tr>
                    </table>
                    
                </form>
            </center>   
            <?php
                }//Sinon on affiche le récapitulatif des commandes de l'utilisateur
                else
                {
                 echo "<div id='commandes' >
                            <h1> Mes commandes</h1>
                                <table class='commande'>
                                     <tr>
                                        <th> Numéro de Commande </th>
                                        <th> Date de Commande </th>
                                        <th> Facture </th>
                                     </tr>";

									 while ($commandes = $lesCommandes->fetch(PDO::FETCH_OBJ))
									 {
									   //Mise en forme de la date (explode() coupe en segment une chaîne)
									   $date_cmd= explode(' ',$commandes->date_commande);
									   $date = explode('-',$date_cmd[0]);
            ?>
									   <tr>
										   <td> <?php echo $commandes->nro_commande?> </td>
										   <td> <?php echo $date[2],'/',$date[1],'/',$date[0]?> </td>
										   <td> <a href="index.php?do=facture&nro_commande=<?php echo $commandes->nro_commande ?>" ><img src ="Images/pdf.png"/></a> </td>
									   </tr>
									   <?php
									 }
                               echo "</table>";
                  echo"</div>";
                }
            ?> 
        </div>
    </div>
  
  </BODY>

</HTML>