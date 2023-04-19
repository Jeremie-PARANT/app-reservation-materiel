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
    echo '<div class="erreur"> Le champs prenom est vide </div>';
    }
        else if (!empty($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
        $verif = $prenom;
            if (strlen($prenom)<3) {
                echo '<div class="erreur"> Votre prenom est trop court </div>';
            }
            elseif (strlen($prenom)>30) {
                echo '<div class="erreur"> Votre prenom est trop long </div>';
            }
            elseif ($prenom != ucfirst($prenom)) {
                echo '<div class="erreur"> La 1er lettre de votre prenom doit comporter une majuscule </div>';
            }
            elseif (CaractNumber ($verif) == true){
                echo '<div class="erreur"> Votre prenom contient des caractères spéciaux </div>';
            }
            else {
                return true;
            }
    }
}

function nom (){
    if (empty($_POST['nom'])) {
        echo '<div class="erreur"> Le champs nom est vide </div>';
    }
        else if (!empty($_POST['nom'])) {
        $nom = $_POST['nom'];
        $verif = $nom;
        if (strlen($nom)<3) {
            echo '<div class="erreur"> Votre nom est trop court </div>';
        }
        elseif (strlen($nom)>30) {
            echo '<div class="erreur"> Votre nom est trop long </div>';
        }
        elseif ($nom != ucfirst($nom)) {
            echo '<div class="erreur"> La 1er lettre de votre nom doit comporter une majuscule </div>';
        }
        elseif (CaractNumber ($verif) == true){
            echo '<div class="erreur"> Votre prenom contient des caractères spéciaux </div>';
        }
        else {
            return true;
        }
    }
}

function naissance (){
    $vieux = "1900-00-00 00:00:00";
    if (empty($_POST['naissance'])) {
    echo '<div class="erreur"> Le champs naissance est vide </div>';
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
            return true;
        }
    }
}

function email (){
    if (empty($_POST['email'])) {
        echo '<div class="erreur"> Le champs email est vide </div>';
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
            return true;
        }
    }
}

function mdp (){
    if (empty($_POST['mdp'])) {
        echo '<div class="erreur"> Le champs mdp est vide </div>';
    }
        else if (!empty($_POST['mdp'])) {
        $mdp = $_POST['mdp'];
        if (strlen($mdp)<3) {
            echo '<div class="erreur"> Votre mdp est trop court </div>';
        }
        elseif (strlen($mdp)>100) {
            echo '<div class="erreur"> Votre email est trop long </div>';
        }
        else {
            return true;
        }
    }
}


//inscription caractere non autorisé
//refaire avec preg_match('/[^a-zA-Z0-9\.]/', $your_variable); ou !preg_match('/^[a-zA-Z0-9\.]*$/', $your_variable); si a le temps 
function CaractNumber ($verif) {
    $CaractNumber = ['1','2','3','4','5','6','7','8','9','&','~','"','#','\'','{','(','[','|','`','_','ç','^','à','@',')',']','=','}','$','£','¤','ù','%','*','µ',',','?','.',';',':','/','!','§','-','+','*'];
    $CaractNumberLen = count($CaractNumber);
    for ($i=0; $i<$CaractNumberLen; $i++) {
        if (str_contains($verif, $CaractNumber[$i])) {
            return true;
        }
    }
}

// faire erreur quand a character speciaux et nombre
?>