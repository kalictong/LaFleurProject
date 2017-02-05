$(function()
{
    valid=true;
    regexNom="^[A-Za-zéèç-]{2,20}$";
    regexPrenom="^[A-Za-zéèç-]{2,20}$";
    regexVille="^[A-Za-zéèç-]{2,20}$";
    regexpass="^[A-Za-zéèç-0-9-]{2,20}$";
    regexEmail="^[a-z0-9._-]+[^._-]@[a-z0-9._-]+([a-z0-9]+[^._-])?[.-]+[a-z0-9]{2,4}$";
    regexCP="^[0-9]{5}$";
    
    /* regex est un objet permettant de manipuler des expressions régulières (caractère ASCII)*/
    
    $("#envoyer").click(function()
    {
        $(".controlForm").remove();
        valid=true;
        control("#ins_nom","Entrez votre nom","Nom incorrect",regexNom);
        control("#ins_prenom","Entrez votre prénom","Prénom incorrect",regexPrenom);
        control("#ins_email","Entrez une adresse email","Email incorrect",regexEmail);
        control("#ins_ville","Entrez une ville","Ville incorrecte",regexVille);
        control("#ins_adresse","Entrez une adresse","","0");
        control("#ins_CP","Entrez un code postal","CP incorrect",regexCP);
        control("#pass","Entrez un Mot de passe","","0");
        control("#pass2","Confirmez le mot de passe","","0");
        
     if($("#pass").val()!==$("#pass2").val() && $("#pass2").val()!=="")
        {
            $("#pass2").css("border-color","red");
            $("#pass2").after('<span class="controlForm"> Mot de passe non valide </span>');
            valid=false;
        }
     
    
        $(".controlForm").fadeIn();
        
        return valid;
    })
});

/* Controle la saisie dans les champs d'un formulaire en affichant une span de class="controlForm"
* parametre =$input ->selection jquery de la balise input
*           $text->texte à afficher si le champs est vide
*           $text2->texte à afficher si le champs n'est pas valide (mettre une chaine vide "", si il n'y a aucune condition a respecter
*           $regex-> expression reguliere à respecter pour la validité
 */
function control(input,text,text2,regex)
{
    if($(input).val()=="")
    {
        $(input).css("border-color","red");
        $(input).after('<span class="controlForm"> <img src="Images/erreur.png" alt="Erreur" /> '+text+' </span>');
        valid=false;
    }
    else
    {
        if(text2!=="")
        {
            if($(input).val().match(regex))
            {
                $(input).css("border-color","green");
                $(".controlForm").fadeOut();
            }
            else
            {
                $(input).css("border-color","red");
                $(input).after('<span class="controlForm"> <img src="Images/erreur.png" alt="Erreur" /> '+text2+' </span>');
                valid=false;
            }
        }
        else
        {
            $(input).css("border-color","green");
            $(".controlForm").fadeOut();
        }
    }
}