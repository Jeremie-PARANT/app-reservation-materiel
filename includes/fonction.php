<style>
    .erreur {
        color:red;
        position: relative;
    }
</style>
<?php
// inscription erreur
function prenom (){
    if (empty($_POST['prenom'])) {
    }
        else if (!empty($_POST['prenom'])) {
        $prenom = ($_POST['prenom']);
            if (strlen($prenom)<3) {
                $erreur_prenom =  '<div class="erreur"> Votre prenom est trop court </div>';
                return $erreur_prenom;
            }
            elseif (strlen($prenom)>50) {
                $erreur_prenom =  '<div class="erreur"> Votre prenom est trop long </div>';
                return $erreur_prenom;
            }
            elseif (!preg_match("#^[A-Z]+$#", $prenom[0])) {
                $erreur_prenom =  '<div class="erreur"> La 1er lettre de votre prenom doit comporter une majuscule </div>';
                return $erreur_prenom;
            }
            elseif (!preg_match("#^[a-zA-Z0-9'-.àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $prenom)) {
                $erreur_prenom = '<div class="erreur"> Votre prenom contient des charactères non autorisé </div>';
                return $erreur_prenom;
             }
            else {
                return false;
            }
    }
}

function nom (){
    if (empty($_POST['nom'])) {

    }
        else if (!empty($_POST['nom'])) {
        $nom = ($_POST['nom']);
        if (strlen($nom)<3) {
            $erreur_nom =  '<div class="erreur"> Votre nom est trop court </div>';
            return $erreur_nom;
        }
        elseif (strlen($nom)>50) {
            $erreur_nom =  '<div class="erreur"> Votre nom est trop long </div>';
            return $erreur_nom;
        }
        elseif (!preg_match("#^[A-Z]+$#", $nom[0])) {
            $erreur_nom =  '<div class="erreur"> La 1er lettre de votre pnom doit comporter une majuscule </div>';
            return $erreur_nom;
        }
        elseif (!preg_match("#^[a-zA-Z0-9'-.àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $nom)) {
            $erreur_nom =  '<div class="erreur"> Votre nom contient des charactères non autorisé </div>';
            return $erreur_nom;
         }
        else {
            return false;
        }
    }
}

function validateDate($naissance, $format) //utiliser dans function naissance
{
    if (DateTime::createFromFormat($format, $naissance)==true){
        return true;
    }
}

function naissance (){
    $vieux = "1900-00-00 00:00:00";
    if (empty($_POST['naissance'])) {

    }
        else if (!empty($_POST['naissance'])) {
        $naissance = ($_POST['naissance']);
        $today = date("Y-m-d H:i:s");
        $format = 'Y-m-d';
        $validate_date = DateTime::createFromFormat($format, $naissance);
        if((validateDate($naissance, $format))!=true){
            $erreur_date = '<div class="erreur"> pas une date </div>';
            return $erreur_date;
        }
        elseif ($naissance > $today) {
            $erreur_date = '<div class="erreur"> Vous venez du futur </div>';
            return $erreur_date;
        }
        elseif ($naissance < $vieux) {
            $erreur_date = '<div class="erreur"> Etes-vous vraiment encore vivant ? </div>';
            return $erreur_date;
        }
        else {
            return false;
        }
    }
}

function email (){
    if (empty($_POST['email'])) {

    }
        else if (!empty($_POST['email'])) {
        $email = ($_POST['email']);
        if (strlen($email)<3) {
            $erreur_email = '<div class="erreur"> Votre email est trop court </div>';
            return $erreur_email;
        }
        elseif (strlen($email)>100) {
            $erreur_email = '<div class="erreur"> Votre email est trop long </div>';
            return $erreur_email;
        }
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
            $erreur_email = '<div class="erreur"> Email non valide </div>';
            return $erreur_email;
        }
        else {
            return false;
        }
    }
}

function mdp (){
    if (empty($_POST['mdp'])) {

    }
        else if (!empty($_POST['mdp'])) {
        $mdp = ($_POST['mdp']);
        if (strlen($mdp)<8) {
            $erreur_mdp = '<div class="erreur"> Votre mdp est trop court </div>';
            return $erreur_mdp;
        }
        elseif (strlen($mdp)>100) {
            $erreur_mdp = '<div class="erreur"> Votre mdp est trop long </div>';
            return $erreur_mdp;
        }
            elseif (!preg_match("#^[a-zA-Z0-9()!-.?_`~;:ù&*+=^%\#\$[\]]+$#",$mdp)) {//
            $erreur_mdp = '<div class="erreur"> Le mdp contient des caractères non autorisé </div>';
            return $erreur_mdp;
        }
        elseif (!preg_match('#[A-Z]#', $mdp) || !preg_match('#[a-z]#', $mdp) || !preg_match('#[0-9]#', $mdp)){
            $erreur_mdp = '<div class="erreur"> Au moins 1 minuscule, 1 majuscule, 1 chiffre nécessaire </div>';
            return $erreur_mdp;
        }
    }
    else {
        return false;
    }
}
?>