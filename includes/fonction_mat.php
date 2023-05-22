<?php
function noms (){
    if (empty($_POST['nom'])) {

    }
    else if (!empty($_POST['nom'])) {
        $nom = ($_POST['nom']);
        if (strlen($nom)<2) {
            $erreur_nom =  '<div class="erreur"> Le nom du matériel est court </div>';
            return $erreur_nom;
        }
        elseif (strlen($nom)>100) {
            $erreur_nom =  '<div class="erreur"> Le nom du matériel est trop long </div>';
            return $erreur_nom;
        }
        elseif (!preg_match("#^[a-zA-Z0-9'-.àèìòùÀÈÌÒÙá éíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $nom)) {
            $erreur_nom =  '<div class="erreur"> Votre nom contient des charactères non autorisé </div>';
            return $erreur_nom;
         }
        else {
            return false;
        }
    }
}
function reference (){
    if (empty($_POST['reference'])) {

    }
    else if (!empty($_POST['reference'])) {
        $reference = ($_POST['reference']);

        if (!preg_match("#^[0-9]+$#", $reference)) {
            $erreur_reference =  '<div class="erreur"> Votre reference contient des charactères non autorisé </div>';
            return $erreur_reference;
         }
        else {
            return false;
        }
    }
}


function description (){
    if (empty($_POST['description'])) {
    }
        else if (!empty($_POST['description'])) {
        $description = ($_POST['description']);
            if (strlen($description)<3) {
                $erreur_description =  '<div class="erreur"> Votre description est trop courte </div>';
                return $erreur_description;
            }
            elseif (strlen($description)>50) {
                $erreur_description =  '<div class="erreur"> Votre description est trop longue </div>';
                return $erreur_description;
            }
            elseif (!preg_match("#^[A-Z]+$#", $description[0])) {
                $erreur_description =  '<div class="erreur"> La 1er lettre de votre description doit comporter une majuscule </div>';
                return $erreur_description;
            }
            elseif (!preg_match("#^[a-zA-Z0-9'-.àèìòùÀÈÌÒÙáé íóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $description)) {
                $erreur_description = '<div class="erreur"> Votre description contient des charactères non autorisé </div>';
                return $erreur_description;
             }
            else {
                return false;
            }
    }
}
?>