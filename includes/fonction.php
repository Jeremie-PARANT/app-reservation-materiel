<style>
    .erreur {
        color:red;
        position: relative;
    }
</style>
<?php
function prenom (){
            if (empty($_POST['prenom'])) {
            echo '<div class="erreur"> vide </div>';
            }
                else if (!empty($_POST['prenom'])) {
                $prenom = $_POST['prenom'];
                if (strlen($prenom)<3) {
                    echo '<div class="erreur"> Votre prenom est trop court </div>';
                }
                elseif (strlen($prenom)>30) {
                    echo '<div class="erreur"> Votre prenom est trop long </div>';
                }
                elseif ($prenom != ucfirst($prenom)) {
                    echo '<div class="erreur"> La 1er lettre de votre prenom doit comporter une majuscule </div>';
                }
                else {
                    echo '<div class="erreur"> Votre prenom est conforme </div>';
                }
            }
}

function nom (){
    if (empty($_POST['nom'])) {
        echo '<div class="erreur"> vide </div>';
    }
        else if (!empty($_POST['nom'])) {
        $nom = $_POST['nom'];
        if (strlen($nom)<3) {
            echo '<div class="erreur"> Votre nom est trop court </div>';
        }
        elseif (strlen($nom)>30) {
            echo '<div class="erreur"> Votre nom est trop long </div>';
        }
        elseif ($nom != ucfirst($nom)) {
            echo '<div class="erreur"> La 1er lettre de votre nom doit comporter une majuscule </div>';
        }
        else {
            echo '<div class="erreur"> Votre nom est conforme </div>';
        }
    }
}

function naissance (){
    $vieux = "1900-00-00 00:00:00";
    if (empty($_POST['naissance'])) {
    echo '<div class="erreur"> vide </div>';
    }
        else if (!empty($_POST['naissance'])) {
        $naissance = $_POST['naissance'];
        $today = date("Y-m-d H:i:s");
        if ($naissance > $today) {
            echo '<div class="erreur"> Vous venez du futur </div>';
        }
        elseif ($naissance < $vieux) {
            echo '<div class="erreur"> Etes-vous vraiment encore vivant </div>';
        }
        else {
            echo '<div class="erreur"> Vous etes en vie et ne venez pas du futur </div>';
        }
    }
}

function email (){
    if (empty($_POST['email'])) {
        echo '<div class="erreur"> vide </div>';
    }
        else if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        if (strlen($email)<3) {
            echo '<div class="erreur"> Votre email est trop court </div>';
        }
        elseif (strlen($email)>100) {
            echo '<div class="erreur"> Votre email est trop long </div>';
        }
        elseif (strlen($email)>100) {
            echo '<div class="erreur"> Votre email est trop long </div>'; // @ a vérifier
        }
        else {
            echo '<div class="erreur"> Votre email est conforme </div>';
        }
    }
}
// faire erreur quand a character speciaux et nombre
?>