<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiel</title>
</head>
<body><?php
    if (empty($_SESSION['mail'])){ //vérifie si connecté
        echo 'vous devez vous connecté';
    }
    else { //(changer quand autorisation ok)
        $mail = $_SESSION['mail'];
        $link = mysqli_connect("localhost", "root", "", "sae_203");
        $result1 = mysqli_query($link, "SELECT autorisation FROM utilisateurs WHERE mail='$mail'");
        $row1 = mysqli_fetch_array($result1);
        $autorisation = $row1['autorisation'];
        
        if ($autorisation==false) { //page utilisateur
            include_once('includes/header.php');
            $result = mysqli_query($link, "SELECT * FROM materiels");

            echo " <table border=1>" ; //table
            while ($row = mysqli_fetch_assoc($result)) {
                $nom = htmlspecialchars($row['nom']);
                $type = htmlspecialchars($row['type']);
                $reference = htmlspecialchars($row['reference']);
                echo "<tr> <td>" . 'image' . "</td><td>". $nom ."</br>". $type ."</br>". $reference ."</br>".
                "<a href=\"connexion.php\"><div>details</div></a>" . "</TD> </tr>" ; //ajouté la bonne page quand il faudra
                }
            echo " </table> " ;

            include_once('includes/footer.php');
        }

        else { //page admin
            echo 'admin';

        }
    }
/* Code pour affichage de la page celon l'autorisation
    if (empty($_SESSION['mail'])){ //vérifie si connecté
        echo 'vous devez vous connecté';
    }
    else {
        $mail = $_SESSION['mail'];
        $autorisation = $_SESSION['autorisation'];
        
        if ($autorisation==false) {
            //page utilisateur (sans autorisation)
        }

        else {
            //page admin
        }
    }

    si page admin = page utilisateur :
        if (empty($_SESSION['mail'])){ //vérifie si connecté
        echo 'vous devez vous connecté';
    }
    else {
        //la page
    }


*/


?></body>
</html>

