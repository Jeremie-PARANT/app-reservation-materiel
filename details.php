<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/tableau.css">
    <title>Details</title>
</head>
<body><?php
if (empty($_SESSION['mail'])){ //Vérifie connection
    include_once('includes/redirection_connexion.php');
}
else{
    if (empty($_GET['reference'])){ //Vérifie référence du matériel à afficher
        echo '<a href=materiel.php>Aucun matériels, retour à la liste des matériels</a>';
    }
    else {
        include_once('includes/variable.php');
        include_once('includes/fonction.php');
        include_once('includes/header.php');

        $ref = $_GET['reference'];
        $result_current_material = mysqli_query($link, "SELECT * FROM materiels WHERE reference ='$ref'");

        while ($row_current_material = mysqli_fetch_assoc($result_current_material)) {//prepare Tableau
            if ($row_current_material['reference'] == $ref) {
                //   ---   DETAILS MATERIEL   ---   //
                $nom = htmlspecialchars($row_current_material['nom']);
                $type = htmlspecialchars($row_current_material['type']);
                $reference = htmlspecialchars($row_current_material['reference']);
                $description = htmlspecialchars($row_current_material['description']);
                
                //Tableau
                echo '<div class="reserve">Réservation en attente</div>
                <table>';
                echo '<tr> <td>' . image($type) . '</td><td>'. $nom .'</br>'. $type .'</br>'. $reference .'</br>'. $description .'</br>';
                echo ' </tr> </table> ' ;


                if (!empty($autorisation) && $autorisation==true) {
                    //   ---   MODIFIER MATERIELS SI ADMIN   ---   //
                    //formulaire
                    echo'</br>MODIFICATION';
                    echo '<form action='.$url.' method=\'post\'>
                    <div class="form_txt">Nom du produit : </div><input type="text" name="nom">
                    <div class="form_txt">Type : </div><input type="text" name="type">
                    <div class="form_txt">Description : <textarea id="champs" type="text" name="description" size="10"></textarea>
                    </br><input type="submit">
                    </form>';

                    //envoie à la BDD
                    if (!empty($_POST['nom'])){     //envoie nom
                        $nouv_nom = mysqli_real_escape_string($link, $_POST['nom']);
                        $result_modif_nom = mysqli_query($link, "UPDATE materiels SET nom = '$nouv_nom' WHERE reference ='$reference'");
                        header("location: $url");
                    }
                    if (!empty($_POST['type'])){     //envoie type
                        $nouv_type = mysqli_real_escape_string($link, $_POST['type']);
                        $result_modif_type = mysqli_query($link, "UPDATE materiels SET type = '$nouv_type' WHERE reference ='$reference'");
                        header("location: $url");
                    }
                    if (!empty($_POST['description'])){     //envoie description
                        $nouv_description = mysqli_real_escape_string($link, $_POST['description']);
                        $result_modif_description = mysqli_query($link, "UPDATE materiels SET description = '$nouv_description' WHERE reference ='$reference'");
                        header("location: $url");
                    }
                    
                include_once('includes/footer.php');
                break;
                }
            }
            else {
                echo '<a href=materiel.php>Aucun matériels, retour à la liste des matériels</a>';
            }
        }
    }
}



?></body>