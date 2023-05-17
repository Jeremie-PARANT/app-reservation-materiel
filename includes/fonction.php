<style>
    .erreur {
        color:red;
        position: relative;
    }
</style>
<?php
//     -----    INSCRIPTION   -----     //
//erreur prenom
function prenom(){
    if (empty($_POST['prenom'])) {
    }
    elseif (!empty($_POST['prenom'])) {
    $prenom = ($_POST['prenom']);
        if (strlen($prenom)<2) {
            $erreur_prenom =  '<div class="erreur"> Votre prenom est trop court </div>';
            return $erreur_prenom;
        }
        elseif (strlen($prenom)>100) {
            $erreur_prenom =  '<div class="erreur"> Votre prenom est trop long </div>';
            return $erreur_prenom;
        }
        elseif (!preg_match("#^[A-Z]+$#", $prenom[0])) {
            $erreur_prenom =  '<div class="erreur"> La 1er lettre de votre prenom doit comporter une majuscule </div>';
            return $erreur_prenom;
        }
        elseif (!preg_match("#^[a-zA-Z0-9'-. àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $prenom)) {
            $erreur_prenom = '<div class="erreur"> Votre prenom contient des charactères non autorisé </div>';
            return $erreur_prenom;
            }
        else {
            return false;
        }
    }
}

//erreur nom
function nom(){
    if (empty($_POST['nom'])) {
    }
        elseif (!empty($_POST['nom'])) {
        $nom = ($_POST['nom']);
        if (strlen($nom)<2) {
            $erreur_nom =  '<div class="erreur"> Votre nom est trop court </div>';
            return $erreur_nom;
        }
        elseif (strlen($nom)>100) {
            $erreur_nom =  '<div class="erreur"> Votre nom est trop long </div>';
            return $erreur_nom;
        }
        elseif (!preg_match("#^[A-Z]+$#", $nom[0])) {
            $erreur_nom =  '<div class="erreur"> La 1er lettre de votre nom doit comporter une majuscule </div>';
            return $erreur_nom;
        }
        elseif (!preg_match("#^[a-zA-Z0-9'-. àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÕÃÑäëïöüÿÄËÏÖÜŸç]+$#", $nom)) {
            $erreur_nom =  '<div class="erreur"> Votre nom contient des charactères non autorisé </div>';
            return $erreur_nom;
         }
        else {
            return false;
        }
    }
}

//Valide date de naissance
function validateDate($naissance, $format)
{
    if (DateTime::createFromFormat($format, $naissance)==true){
        return true;
    }
}

//erreur naissance
function naissance(){
    $vieux = "1900-00-00 00:00:00";
    if (empty($_POST['naissance'])) {

    }
        elseif (!empty($_POST['naissance'])) {
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

//erreur email
function email(){
    if (empty($_POST['email'])) {

    }
        elseif (!empty($_POST['email'])) {
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

//erreur mdp
function mdp(){
    if (empty($_POST['mdp'])) {

    }
        elseif (!empty($_POST['mdp'])) {
        $mdp = ($_POST['mdp']);
        if (strlen($mdp)<6) {
            $erreur_mdp = '<div class="erreur"> Au moins 6 charactères </div>';
            return $erreur_mdp;
        }
        elseif (strlen($mdp)>100) {
            $erreur_mdp = '<div class="erreur"> Maximum 100 charactères </div>';
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
//     -----    INSCRIPTION   -----     //



//     -----    MATERIEL   -----     //
//inscription materiel
function image($type){
    if (!empty($type)) {
        $type = htmlspecialchars($type);
        if ($type=="micro"){
            return '<img src="images/'.$type.'.png" class="image"></img>';
        }
        elseif ($type=="camera"){
            return '<img src="images/'.$type.'.png" class="image"></img>';
        }
        elseif ($type=="trepied"){
            return '<img src="images/'.$type.'.png" class="image"></img>';
        }
        elseif ($type=="fond_vert"){
            return '<img src="images/'.$type.'.png" class="image"></img>';
        }
        else {
            return '<img src="images/no_image.png" class="image"></img>';
        }
    }
    else {
        return '<img src="images/no_image.png" class="image"></img>';
    }
}

//description pas trop longue
function decription100($description){
    if (strlen(htmlspecialchars($description))>100){
        $description = substr($description, 0, 100) . '...' ;
        return $description;
    }
    else {
        return htmlspecialchars($description);
    }
}

//     -----    MATERIEL   -----     //



//     -----    RESERVATION   -----     //
//reservation date début
function date_debut(){
    $vieux = "1900-00-00 00:00:00";
    if (empty($_POST['date_debut'])) {

    }
        elseif (!empty($_POST['date_debut'] && !empty($_POST['date_fin']))) {
        $date_debut = ($_POST['date_debut']);
        $date_fin = ($_POST['date_fin']);
        $today = date("Y-m-d H:i:s");
        $format = 'Y-m-d';
        $validate_date = DateTime::createFromFormat($format, $date_debut);
        if ((validateDate($date_debut, $format))!=true){
            $erreur_date_debut = '<div class="erreur"> pas une date </div>';
            return $erreur_date_debut;
        }
        elseif ($date_debut < $today) {
            $erreur_date_debut = '<div class="erreur"> Vous ne pouvez pas prendre de commande pour le passer </div>';
            return $erreur_date_debut;
        }
        elseif ($date_debut > $_POST['date_fin']) {
            $erreur_date_debut = '<div class="erreur"> La date de fin ne doit pas précèder la date de début </div>';
            return $erreur_date_debut;
        }
        else {
            return false;
        }
    }
}

function date_fin(){
    $vieux = "1900-00-00 00:00:00";
    if (empty($_POST['date_fin'])) {

    }
        elseif (!empty($_POST['date_fin'] && !empty($_POST['date_fin']))) {
        $date_fin = ($_POST['date_fin']);
        $date_fin = ($_POST['date_fin']);
        $today = date("Y-m-d H:i:s");
        $format = 'Y-m-d';
        $validate_date = DateTime::createFromFormat($format, $date_fin);
        if ((validateDate($date_fin, $format))!=true){
            $erreur_date_fin = '<div class="erreur"> pas une date </div>';
            return $erreur_date_fin;
        }
        elseif ($date_fin < $today) {
            $erreur_date_fin = '<div class="erreur"> Vous ne pouvez pas prendre de commande pour le passer </div>';
            return $erreur_date_fin;
        }
        elseif ($date_fin > $_POST['date_fin']) {
            $erreur_date_fin = '<div class="erreur"> La date de fin ne doit pas précèder la date de début </div>';
            return $erreur_date_fin;
        }
        else {
            return false;
        }
    }
}

//     -----    RESERVATION   -----     //

function reservation_collide(){
    if (date_debut()==false && date_fin()==false){
        if (!empty($_POST['date_debut']) && !empty($_POST['date_fin'] && !empty($_POST['nom']))){
            $link = mysqli_connect("localhost", "root", "", "sae_203");
            $materiel_ref = mysqli_real_escape_string($link, $_POST['nom']);
            $date_debut = ($_POST['date_debut']);
            $date_fin = ($_POST['date_fin']);
            $result_check_reservation = mysqli_query($link, "SELECT * FROM reservations WHERE reference='$materiel_ref' AND demande='accepte'");
            while ($row__check_reservation = mysqli_fetch_assoc($result_check_reservation)){
                if ($row__check_reservation['datedebut'] <= $date_debut && $row__check_reservation['datefin'] >= $date_debut OR $row__check_reservation['datedebut'] <= $date_fin && $row__check_reservation['datefin'] >= $date_debut){
                    $erreur_date_collide = '<div class="erreur"> Ce matériel a déjà été reserver au date suivante </div>';
                    return $erreur_date_collide;
                }
                else {
                    return false;
                }
            }
        }
    }
}
?>