<!-- Développé par Mehdi MEGROUS-->
<HTML>
    <HEAD>
        <TITLE>Inscription</TITLE>
        <!--Feuilles de style global-->
        <link rel = "stylesheet" type = "text/css" href = "style/style1.css">
		<!--Feuilles de style des tableaux-->
        <link rel = "stylesheet" type = "text/css" href = "style/formTabl.css">
		<!--Feuilles de style du menu-->
        <link rel = "stylesheet" type = "text/css" href = "style/underlinemenu.css">
        <!--Favicon-->
        <link rel="shortcut icon" href="Images/favicon.png" />
        <!--Fonctions JavaScript-->
        <script type="text/javascript" src="JS/jquery.js"></script>
		<!--Javascript pour les contrôles de saisie-->
        <script type="text/javascript" src="JS/control_inscription.js"></script>

    </HEAD>
    
    <BODY>
        <div id ='page'>
			<!--Contenu de la page-->
            <div id='content'>
            <center>
                <!-- Affichage du formulaire d'inscription!-->
                <form name="inscription" action="index.php?do=inscription&ins=true" method="POST">
                    <img src="Images/inscription.jpg"/>
                    <table>
                        <tr>
                            <td>Nom :</td>
                            <td><input type="text" name="ins_nom" id="ins_nom"></td>
                        </tr>
                
                        <tr>
                            <td>Prénom :</td>
                            <td><input type="text" name="ins_prenom" id="ins_prenom"></td>
                        </tr>
    
                        <tr>
                            <td>Adresse :</td>
                            <td><input type="text" name="ins_adresse" id="ins_adresse"></td>
                        </tr>
    
                        <tr>
                            <td>Code postal :</td>
                            <td><input type="text" name="ins_CP" id="ins_CP"></td>
                        </tr>
    
                        <tr>
                            <td>Ville :</td>
                            <td><input type="text" name="ins_ville" id="ins_ville"></td>
                        </tr>

                        <tr>
                            <td>E-mail :</td>
                            <td><input type="text" name="ins_email" id="ins_email"></td>
                        </tr>   

                        <tr>
                            <td>Mot de passe :</td>
                            <td><input type="password" name="pass" id="pass"></td>
                        </tr>
    
                        <tr>
                            <td>Confirmation du mot de passe :</td>
                            <td><input type="password" name="pass2" id="pass2"></td>
                        </tr>   
                        
                        <br>
                        <br>
                
                        <tr>
                            <td align="right">
                                <input type="submit" value="Envoyer" id="envoyer" style="width: 150px">
                                <input type="reset" value="Annuler" style="width: 80px">
                            </td>
                        </tr>
                    </table>
                    <br>
                </form>
            </center>       
            </div>
        </div>
    </BODY>
</HTML>