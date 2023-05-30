<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/tableau.css">
    <title>Materiel</title>
</head>
<body><?php
    if (empty($_SESSION['mail'])){ //Vérifie connection
        include_once('includes/redirection_connexion.php');
    }
    else {
        include_once('includes/variable.php');
        include_once('includes/fonction.php');
        include_once('includes/header.php');

        //BARRE DE RECHERCHE
        echo '<form class="rech_droite" action="materiel.php" method="post">
        <div class="form_txt">Recherche :</div><input type="text" name="nom_materiel">
        </form>';
        if (!empty($_POST['nom_materiel'])){
            $nom_materiel = mysqli_real_escape_string($link, $_POST['nom_materiel']);
        }
        else {
            $nom_materiel = '';
        }
            //   ---   TABLEAU   ---   //
        $result_m = mysqli_query($link, "SELECT * FROM materiels WHERE nom LIKE '$nom_materiel%'");
        echo "<div class=\"reserve\">Liste des matériels</div>
        <table>" ;
        while ($row_m = mysqli_fetch_assoc($result_m)) {
            $nom = htmlspecialchars($row_m['nom']);
            $type = htmlspecialchars($row_m['type']);
            $reference = htmlspecialchars($row_m['reference']);
            $description = htmlspecialchars($row_m['description']);
            $description = decription100 ($description);
            echo "<tr> <td>" . image($type) . "</td><td>". $nom ."</br>". $type ."</br>". $reference ."</br>". $description ."</br>".
            "<a href=\"details.php?reference=". $reference ."\"><div class=\"details\">details</div></a>" . "</TD>" ;
            }
        echo " </tr> </table> " ;

        include_once('includes/footer.php');
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

