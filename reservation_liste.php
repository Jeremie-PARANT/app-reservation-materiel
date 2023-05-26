<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/tableau.css">
    <title>Panier</title>
</head>
<body><?php
    if (empty($_SESSION['mail'])){ //Vérifie connection
        include_once('includes/redirection_connexion.php');
    }
    else {
        $mail = $_SESSION['mail'];
        $autorisation = $_SESSION['autorisation'];


        ////   -----    PAGE UTILISATEUR    -----   ////

        if ($autorisation==false){    
            include_once('includes/variable.php');
            include_once('includes/fonction.php');
            include_once('includes/header.php');

            //BARRE DE RECHERCHE
            echo '<form action="reservation_liste.php" method="post">
            <div class="form_txt">Recherche :</div><input type="text" name="nom_materiel">
            </form>';
            if (!empty($_POST['nom_materiel'])){
                $nom_materiel = mysqli_real_escape_string($link, $_POST['nom_materiel']);
            }
            else {
                $nom_materiel = '';
            }
                //   ---   TABLEAU   ---   //
            //BDD
            $mail_reserv = $mail;
            $result_reservation = mysqli_query($link, "SELECT materiels.nom, materiels.type, materiels.description, materiels.reference, reservations.numreserv, reservations.datedebut , reservations.datefin, reservations.demande from reservations
            join materiels on materiels.reference=reservations.reference
            JOIN utilisateurs on utilisateurs.mail=reservations.mail
            WHERE utilisateurs.mail LIKE '$mail_reserv' AND materiels.nom LIKE '$nom_materiel%'");
            echo "<table>" ;
            //Echo le tableau
            while ($row_reservation = mysqli_fetch_assoc($result_reservation)) {
                //Variable
                $nom = htmlspecialchars($row_reservation['nom']);
                $type = htmlspecialchars($row_reservation['type']);
                $reference = htmlspecialchars($row_reservation['reference']);
                $numreserv = htmlspecialchars($row_reservation['numreserv']);
                $demande = htmlspecialchars($row_reservation['demande']);
                $date_debut = htmlspecialchars($row_reservation['datedebut']);
                $date_fin = htmlspecialchars($row_reservation['datefin']);

                //echo information du tableau
                echo "<tr> <td>" . image($type) . "</td><td>"
                . $nom ." : ". $reference ."</br>"
                . $type ."</br>"
                . $date_debut ." : "
                . $date_fin ."</br>";

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

                //details de la reservation
                echo "<a href=\"reservation_details.php?numreserv=". $numreserv ."\"><div id=\"details\">details</div></a>" . "</TD>" ;
                }
            echo " </tr> </table> " ;

            include_once('includes/footer.php');
        }



        ////   -----    PAGE UTILISATEUR    -----   ////

        elseif ($autorisation==true){
            include_once('includes/variable.php');
            include_once('includes/fonction.php');
            include_once('includes/header.php');

            //BARRE DE RECHERCHE
            echo '<form action="reservation_liste.php" method="post">
            <div class="form_txt">Recherche :</div><input type="text" name="nom_materiel">
            </form>';
            if (!empty($_POST['nom_materiel'])){
                $nom_materiel = mysqli_real_escape_string($link, $_POST['nom_materiel']);
            }
            else {
                $nom_materiel = '';
            }

            //BDD
            $mail_reserv = '%';
            $result_reservation = mysqli_query($link, "SELECT utilisateurs.mail, materiels.nom, materiels.nom, materiels.type, materiels.description, materiels.reference, reservations.numreserv, reservations.datedebut , reservations.datefin, reservations.demande from reservations
            join materiels on materiels.reference=reservations.reference
            JOIN utilisateurs on utilisateurs.mail=reservations.mail
            WHERE utilisateurs.mail LIKE '$mail_reserv' AND materiels.nom LIKE '$nom_materiel%'");

                //   ---   TABLEAU EN ATTENTE  ---   //
            echo "<table>" ;
            echo "<div class=\"reserve\">Réservation en attente</div>";
            while ($row_reservation = mysqli_fetch_assoc($result_reservation)) {
                //Variable
                $nom = htmlspecialchars($row_reservation['nom']);
                $type = htmlspecialchars($row_reservation['type']);
                $reference = htmlspecialchars($row_reservation['reference']);
                $numreserv = htmlspecialchars($row_reservation['numreserv']);
                $demande = htmlspecialchars($row_reservation['demande']);
                $date_debut = htmlspecialchars($row_reservation['datedebut']);
                $date_fin = htmlspecialchars($row_reservation['datefin']);
                $user_mail = htmlspecialchars($row_reservation['mail']);

                if ($demande=='en_attente'){
                    //echo information du tableau
                    echo "<tr> <td>" . image($type) . "</td>
                    <td>". $nom ." : ". $reference ."</br>"
                    . $type ."</br>"
                    . $user_mail ."</br>"
                    . $date_debut ." : ". $date_fin .
                    "</br><div class=\"attente\"> en attente </div></br>";

                    //details de la reservation
                    echo "<a href=\"reservation_details.php?numreserv=". $numreserv ."\"><div class=\"details\">details</div></a>" . "</TD>" ;
                }
            }



                //   ---   TABLEAU ACCEPTE/REFUSE  ---   //
            $result_reservation = mysqli_query($link, "SELECT utilisateurs.mail, materiels.nom, materiels.nom, materiels.type, materiels.description, materiels.reference, reservations.numreserv, reservations.datedebut , reservations.datefin, reservations.demande from reservations
            join materiels on materiels.reference=reservations.reference
            JOIN utilisateurs on utilisateurs.mail=reservations.mail
            WHERE utilisateurs.mail LIKE '$mail_reserv' AND materiels.nom LIKE '$nom_materiel%'");

            echo " </tr> </table> " ;
            
            echo "<table>" ;
            echo "<div class=\"reserve\">Réservation acceptées/refusées</div>";
            while ($row_reservation = mysqli_fetch_assoc($result_reservation)) {
                //Variable
                $nom = htmlspecialchars($row_reservation['nom']);
                $type = htmlspecialchars($row_reservation['type']);
                $reference = htmlspecialchars($row_reservation['reference']);
                $numreserv = htmlspecialchars($row_reservation['numreserv']);
                $demande = htmlspecialchars($row_reservation['demande']);
                $date_debut = htmlspecialchars($row_reservation['datedebut']);
                $date_fin = htmlspecialchars($row_reservation['datefin']);
                $user_mail = htmlspecialchars($row_reservation['mail']);

                if ($demande!='en_attente'){
                    //echo information du tableau
                    echo "<tr> <td>" . image($type) . "</td>
                    <td>". $nom ." : ". $reference ."</br>"
                    . $type ."</br>"
                    . $user_mail ."</br>"
                    . $date_debut ." : ". $date_fin ."</br>";

                    //echo demande (validation)
                    if ($demande == 'accepte'){
                        echo '<div class="accepte"> acceptée </div></br>';
                    }
                    elseif ($demande == 'refuse'){
                        echo '<div class="refuse"> refusée </div></br>';
                    }
                    else {
                        echo '<div class="erreur"> demande incorrecte </div>';
                    }

                    //details de la reservation
                    echo "<a href=\"reservation_details.php?numreserv=". $numreserv ."\"><div class=\"details\">details</div></a>" . "</TD>" ;
                }
            }
            echo " </tr> </table> " ;

            include_once('includes/footer.php');
        }
    }

?></body>
</html>

