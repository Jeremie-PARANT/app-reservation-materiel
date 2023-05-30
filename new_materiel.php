<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/new_materiel2.css">
<title>Ajouter du matériel</title>
<?php
    include_once('includes/fonction_mat.php');
    include_once('includes/variable.php');
    include_once('includes/header.php');
    include_once('includes/footer.php');
?>
</head>
<body>
<?php 
if (empty($_SESSION['mail'])){ //Vérifie connection
    include_once('includes/redirection_connexion.php');
}
else{
            //Début Formulaire nouveau matériel
            echo "<form action='new_materiel.php' method='post'>
    <div id=\"div_formulaire\">

        <div id=\"titre\">
            <p>Information sur le matériel : </p>
        </div>";



        //Contenu des informations pour remplir le Formulaire
        echo "<div id=\"container\">
            <div id=\"div_info\">";




                //Inserer le Nom du matériel
                echo "<p>Nom : </p>
                <input class=\"champs_info\" type=\"text\" name=\"nom\" required=\"required\">";
                $erreur_nom=noms(); // erreur de noms 
                if ($erreur_nom!=false){
                echo $erreur_nom;
                }   
                echo "<br>
                <br>";




                //Inserer le Type du matériel, on peux ajouter si besoin
                echo "<p>Type : </p>
                <select class=\"champs_info\" name=\"type\" required=\"required\">
                    <option value=\"\">-- Type de matériel --</option>
                    <option value=\"camera\">Caméra</option>
                    <option value=\"micro\">micro</option>
                    <option value=\"fond_vert\">Fond vert</option>
                    <option value=\"Trépied\">Trépied</option>
                </select>
    
                <br>
                <br>";



                //Inserer la Réference du matériel (que des chiffres)
                echo "<p>Référence : </p>
                <input class=\"champs_info\" type=\"text\" name=\"reference\" required=\"required\">";
                

                $erreur_reference=reference(); // erreur de noms 
                if ($erreur_reference!=false){
                echo $erreur_reference;
                }

            
            echo "</div>";



            //Ajouter une description au matériel
            echo "<div id=\"description\">

                <p>Description : </p>
                <textarea id=\"champs\" type=\"text\" name=\"description\" size=\"10\" required=\"required\"></textarea>";

            $erreur_description=description(); // erreur de noms 
            if ($erreur_description!=false){
            echo $erreur_description;
            }

            echo "</div> 
        </div>
        <br>
        <br>";



                //Bouton pour ajouter le matériel à la BDD
        echo "<div id=\"div_boutton\">
            <button type=\"submit\" id=\"boutton_ajout\">Ajouter nouveau matériel</button>
        </div>
    </div>
</form>
</div> ";//Fin du Formulaire




            //Code qui permet d'ajouter le matériel

    

    //Définir les matériels et ne pas pouvoir les modifier
    define('ALLOWED_TYPES', ['camera', 'Trépied', 'micro', 'fond_vert']);



// Vérifier si la référence n'est pas vide
if (!empty($_POST['reference'])) {
$reference = $_POST['reference'];





// Vérifier les autorisations et les références
$query = "SELECT autorisation FROM utilisateurs WHERE mail='$mail';";
$queryref = "SELECT reference FROM materiels WHERE reference='$reference';";
$checkref = mysqli_query($link, $queryref);



// Afficher un message si la référence est déjà utilisée
if (mysqli_num_rows($checkref) != 0) {
    echo '<div class="erreur">Référence déjà utilisée</div>';
}


// Afficher un message si le type est incorrect
elseif (!empty($_POST['type'])) {
    if (!in_array($_POST['type'], ALLOWED_TYPES)) {
        echo "Type incorrect";
    }


        // Envoyer les informations à la base de données 
else {
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($result)) {
    // Vérifier les autorisations
    if ($row['autorisation'] == '1') {
        if (noms() == false && reference() == false && description() == false) {
            if (!empty($_POST['nom']) || !empty($_POST['reference']) || !empty($_POST['description'])) {
                // Éviter les injections de code dans la base de données en utilisant mysqli_real_escape_string
                $nom = mysqli_real_escape_string($link, $_POST['nom']);
                $reference = mysqli_real_escape_string($link, $_POST['reference']);
                $type = mysqli_real_escape_string($link, $_POST['type']);
                $description = mysqli_real_escape_string($link, $_POST['description']);

                // Insérer le matériel dans la base de données
                $query = "INSERT INTO materiels (reference, nom, type, description) VALUES ('$reference', '$nom', '$type', '$description');";
                mysqli_query($link, $query);

                // Afficher un message d'ajout
                echo "Votre matériel a bien été ajouté";
            }
        }
    }
}
}
}   
}
include_once('includes/footer.php');
}



?>
</body>
</html>