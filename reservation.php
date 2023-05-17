<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
</head>
<body><?php
if (empty($_SESSION['mail'])){ //vérifie si connecté
    include_once('includes/redirection_connexion.php');
}
//   ---   PAGE DE RESERVATION   ---   //
else { //FORMULAIRE
    include_once('includes/variable.php');
    include_once('includes/fonction.php');
    include_once('includes/header.php');
    
    //Select reférence forms
    echo '<h1>Faire une réservation :</h1>
    <form action="'.$url.'" method=\'post\'>
    <select class="champs_info" name="nom" required="required">';//Selectionne tous les matériel
    $result_all_material = mysqli_query($link, "SELECT nom, reference FROM materiels");
    
    while ($row_all_material = mysqli_fetch_assoc($result_all_material)){
        $nom = mysqli_real_escape_string($link, $row_all_material['nom']);
        $reference = mysqli_real_escape_string($link, $row_all_material['reference']);
        echo '<option value="'.$reference.'">'.$nom.' : '.$reference.'</option>';
    }

    //DATE
    //Date debut 
    echo '</select>
    <div class="form_txt">Date de début : </div><input type="date" name="date_debut" required="required">';
    $erreur_date_debut=date_debut();// erreur de date_debut 
    if ($erreur_date_debut!=false){
        echo $erreur_date_debut;
    }
    //Date fin
    echo '<div class="form_txt">Date de fin : </div><input type="date" name="date_fin" required="required">';
    $erreur_date_fin=date_fin(); // erreur de date_fin 
    if ($erreur_date_fin!=false){
        echo $erreur_date_fin;
    }
    echo '</br><input type="submit">
    </form>';
    $erreur_reservation_collide=reservation_collide(); // erreur réservation collide
    if (reservation_collide()!=false){
        echo $erreur_reservation_collide;
    }


    //   ---   ENVOIE VERS BDD   ---   //
    //Verifie erreur date
    if  (date_debut()==false && date_fin()==false && !empty($_POST['nom'])){
        $materiel_ref = mysqli_real_escape_string($link, $_POST['nom']);
        $user = mysqli_real_escape_string($link, $_SESSION['mail']);
        
        //Verifie si matériel existe
        $query_materiel_exist = "SELECT reference FROM materiels WHERE reference='".$materiel_ref."'";
        $checkmateriel = mysqli_query($link, $query_materiel_exist);

        if (mysqli_num_rows($checkmateriel) != 1) {
            echo '<div class="erreur"> Le matériel selectionner n\'existe pas </div>';
        }
        elseif (!empty($row__check_reservation['reference'])) {
            echo 'déjà reserver';
        }
        //Envoie vers BDD
        elseif (reservation_collide()==false){
            $date_debut = mysqli_real_escape_string($link, $_POST['date_debut']);
            $date_fin = mysqli_real_escape_string($link, $_POST['date_fin']);
            $demande = 'en_attente';
            echo 'envoie vers la BDD';
            $result_reservation = mysqli_query($link, "INSERT INTO reservations(datedebut, datefin, demande, mail, reference) VALUES ('$date_debut', '$date_fin', '$demande', '$user', '$materiel_ref')");
        }
    }


    include_once('includes/footer.php');
}

?></body>