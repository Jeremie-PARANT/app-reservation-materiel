<style>
    .erreur {
        color:red;
        position: relative;
    }
</style>
<?php
// inscription eurreur
function prenom (){
    if (empty($_POST['prenom'])) {

    }
        else if (!empty($_POST['prenom'])) {
        $prenom = strip_tags($_POST['prenom']);
            if (strlen($prenom)<3) {
                echo '<div class="erreur"> Votre prenom est trop court </div>';
            }
            elseif (strlen($prenom)>50) {
                echo '<div class="erreur"> Votre prenom est trop long </div>';
            }
            elseif (!preg_match("#^[A-Z]+$#", $prenom[0])) {
                echo '<div class="erreur"> La 1er lettre de votre prenom doit comporter une majuscule </div>';
            }
            elseif (!preg_match("#^[a-zA-Z0-9'-.àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $prenom)) {
                echo '<div class="erreur"> Votre prenom contient des charactères non autorisé </div>';
             }
            else {
                return true;
            }
    }
}

function nom (){
    if (empty($_POST['nom'])) {

    }
        else if (!empty($_POST['nom'])) {
        $nom = strip_tags($_POST['nom']);
        if (strlen($nom)<3) {
            echo '<div class="erreur"> Votre nom est trop court </div>';
        }
        elseif (strlen($nom)>50) {
            echo '<div class="erreur"> Votre nom est trop long </div>';
        }
        elseif (!preg_match("#^[A-Z]+$#", $nom[0])) {
            echo '<div class="erreur"> La 1er lettre de votre pnom doit comporter une majuscule </div>';
        }
        elseif (!preg_match("#^[a-zA-Z0-9'-.àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $nom)) {
            echo '<div class="erreur"> Votre nom contient des charactères non autorisé </div>';
         }
        else {
            return true;
        }
    }
}

function naissance (){
    $vieux = "1900-00-00 00:00:00";
    if (empty($_POST['naissance'])) {

    }
        else if (!empty($_POST['naissance'])) {
        $naissance = strip_tags($_POST['naissance']);
        $today = date("Y-m-d H:i:s");
        if(!checkdate($naissance[0-4], $naissance[5-6], $naissance[7-8])==true){
            echo '<div class="erreur"> pas une date ou voyage dans le temps </div>';
        }
        elseif ($naissance > $today) {
            echo '<div class="erreur"> Vous venez du futur </div>';
        }
        elseif ($naissance < $vieux) {
            echo '<div class="erreur"> Etes-vous vraiment encore vivant </div>';
        }
        else {
            return true;
        }
    }
}

function email (){
    if (empty($_POST['email'])) {

    }
        else if (!empty($_POST['email'])) {
        $email = strip_tags($_POST['email']);
        if (strlen($email)<3) {
            echo '<div class="erreur"> Votre email est trop court </div>';
        }
        elseif (strlen($email)>100) {
            echo '<div class="erreur"> Votre email est trop long </div>';
        }
        elseif (!preg_match('#@#',$email)) {
            echo '<div class="erreur"> L\'email ne contient pas @ </div>';
        }
        elseif (!preg_match("#^[a-zA-Z0-9@!%&'*+-/=?^_`{|}~.\$\#]+$#",$email)) {
            echo '<div class="erreur"> L\'email contient des caractères non autorisé </div>';
        }
        else {
            return true;
        }
    }
}

function mdp (){
    if (empty($_POST['mdp'])) {

    }
        else if (!empty($_POST['mdp'])) {
        $mdp = strip_tags($_POST['mdp']);
        if (strlen($mdp)<8) {
            echo '<div class="erreur"> Votre mdp est trop court </div>';
        }
        elseif (strlen($mdp)>100) {
            echo '<div class="erreur"> Votre mdp est trop long </div>';
        }
        //elseif (!preg_match("#^[a-zA-Z0-9(!)-.?_`~;:ù-&*+=^%\#\$[]]+$#",$mdp)) {
            elseif (!preg_match("#^[a-zA-Z0-9()!-@.?_`~;:ù-]+$#",$mdp)) {
            echo '<div class="erreur"> Le mdp contient des caractères non autorisé </div>';
        }
        else {
            return true;
        }
    }
}
?>