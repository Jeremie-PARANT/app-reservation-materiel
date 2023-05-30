<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/tableau.css">
    <title>Details de la réservation</title>
</head>
<body><?php
if (empty($_SESSION['mail'])){ //Vérifie connection
    include_once('includes/redirection_connexion.php');
}
else{
    if (empty($_GET['numreserv'])){ //Vérifie référence du matériel à afficher
        echo '<a href=reservation_liste.php>Aucune réservation sélectionner, retour à la liste des réservations</a>';
    }
    else {
        include_once('includes/variable.php');
        include_once('includes/fonction.php');
        include_once('includes/header.php');

        //Query BDD
        $numreserv = $_GET['numreserv'];
        $result_current_reserv = mysqli_query($link, "SELECT utilisateurs.mail, materiels.nom, materiels.nom, materiels.type, materiels.description, materiels.reference, reservations.numreserv, reservations.datedebut , reservations.datefin, reservations.demande from reservations
        join materiels on materiels.reference=reservations.reference
        JOIN utilisateurs on utilisateurs.mail=reservations.mail
        WHERE numreserv = '$numreserv'");

        while ($row_current_reserv = mysqli_fetch_assoc($result_current_reserv)) {//prepare Tableau
            if ($row_current_reserv['numreserv'] == $numreserv) {
                //   ---   DETAILS MATERIEL   ---   //
                $nom = htmlspecialchars($row_current_reserv['nom']);
                $type = htmlspecialchars($row_current_reserv['type']);
                $reference = htmlspecialchars($row_current_reserv['reference']);
                $numreserv = htmlspecialchars($row_current_reserv['numreserv']);
                $demande = htmlspecialchars($row_current_reserv['demande']);
                $date_debut = htmlspecialchars($row_current_reserv['datedebut']);
                $date_fin = htmlspecialchars($row_current_reserv['datefin']);
                $user_mail = htmlspecialchars($row_current_reserv['mail']);
                $description = htmlspecialchars($row_current_reserv['description']);
                
                //TABLEAU
                echo '<div class="reserve">Détails de la réservation</div>
                <table>';
                echo "<tr> <td>" . image($type) . "</td>
                <td>". $nom ." : ". $reference ."</br>"
                . $type ."</br>"
                . $description ."</br>"
                . $user_mail ."</br>"
                . $date_debut ." : ". $date_fin;
                
                //echo demande (validation)
                if ($demande == 'en_attente'){
                    echo '<div class="attente"> en attente </div>';
                }
                elseif ($demande == 'accepte'){
                    echo '<div class="accepte"> acceptée </div>';
                }
                elseif ($demande == 'refuse'){
                    echo '<div class="refuse"> refusée </div>';
                }
                else {
                    echo '<div class="erreur"> demande incorrecte </div>';
                }
                echo ' </tr> </table> ' ;

                break;
            }
            else {
                echo '<a href=reservation_liste.php>Aucune réservation sélectionner, retour à la liste des réservations</a>';
            }
        }
        if (!empty($autorisation) && $autorisation==true && !empty($demande) && $demande=='en_attente') {
            echo '<form action='.$url.' method=\'post\'>
            <button type="submit" name="accepte" value="accepte">accepte</button>
            <button type="submit" name="refuse" value="refuse">refuse</button>
            </form>';

                if (!empty($_POST['accepte']) && $_POST['accepte']=='accepte'){
                    if (reservation_collide_validation()==false){
                        $nouv_demande = mysqli_real_escape_string($link, $_POST['accepte']);
                        $result_modif_demande = mysqli_query($link, "UPDATE reservations SET demande = '$nouv_demande' WHERE numreserv ='$numreserv'");
                        header("location: $url");
                    }
                    else {
                        $erreur_date_collide = reservation_collide_validation();
                        echo $erreur_date_collide;
                    }
                }
                if (!empty($_POST['refuse']) && $_POST['refuse']=='refuse'){
                    $nouv_demande = mysqli_real_escape_string($link, $_POST['refuse']);
                    $result_modif_demande = mysqli_query($link, "UPDATE reservations SET demande = '$nouv_demande' WHERE numreserv ='$numreserv'");
                    header("location: $url");
                }
        }
    }
    include_once('includes/footer.php');
}
?></body>