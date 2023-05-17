<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/new_materiel2.css">
    <title>Ajouter du matériel</title>
    <?php
        include_once('includes/fonction_mat.php');
    ?>
</head>
<body>
<header>

        <!--Ceci est la navbar de la page et il en reste à la fin-->
        <div id="container">
            <div>
                <img id="logo_univ" src="ressource/logo_univ.png" alt="logo université">
            </div>
            <div id="nav">
                <div class="menu">
                    <a class="bouton_menu" href="materiel.php">Matériel</a>
                </div>
                <div class="menu">
                    <a class="bouton_menu" href="demande.html">Mes demandes</a>
                </div>



                <!--Début de la session php-->
                <?php
                session_start();




                //Connexion à la base de données
                $link = mysqli_connect("localhost", "root", "", "sae_203");
                $mail = $_SESSION['mail'];
                $query = "SELECT autorisation FROM utilisateurs WHERE mail='$mail';";
                $result = mysqli_query($link, $query);



                if ($result === false) {
                    // Gérer l'erreur ici, par exemple afficher un message d'erreur à l'utilisateur
                    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($link);
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['autorisation'] == '1') {
                            echo "<div class='menu'>";

                            //Boutons Admin NavBar qui permettent d'aller sur d'autres pages
                            echo "<a class='bouton_menu' href='validation.html'>Validation</a>";
                            echo "</div>";
                            echo "<div class='menu'>";
                            echo "<a class='bouton_menu' href='new_materiel.php'>Ajout de Matériel</a>";
                            echo "</div>";
                        }
                    }
                }
                ?>
            </div>



            <!--Continuité de la navbar (logo compte)-->
            <div id="menu_logo">
                    <img id="logo_compte" src="ressource/logo_compte.png" alt="logo compte">
                </div>
        </div>
    </header> <!--Fin du header-->




                <!--Début Formulaire nouveau matériel-->
    <form action='new_materiel.php' method='post'>
        <div id="div_formulaire">

            <div id="titre">
                <p>Information sur le matériel : </p>
            </div>




            <!--Contenu des informations pour remplir le Formulaire-->
            <div id="container">
                <div id="div_info">




                    <!--Inserer le Nom du matériel-->
                    <p>Nom : </p>
                    <input class="champs_info" type="text" name="nom" required="required">
                    <?php 
                    $erreur_nom=noms(); // erreur de noms 
                    if ($erreur_nom!=false){
                    echo $erreur_nom;
                    }   
                    ?>
                    <br>
                    <br>




                    <!--Inserer le Type du matériel, on peux ajouter si besoin-->
                    <p>Type : </p>
                    <select class="champs_info" name="type" required="required">
                        <option value="">-- Type de matériel --</option>
                        <option value="camera">Caméra</option>
                        <option value="micro">micro</option>
                        <option value="light">light</option>
                        <option value="Trépied">Trépied</option>
                    </select>
        
                    <br>
                    <br>



                    <!--Inserer la Réference du matériel (que des chiffres)-->
                    <p>Référence : </p>
                    <input class="champs_info" type="text" name="reference" required="required">
                    
                    <?php
                    $erreur_reference=reference(); // erreur de noms 
                    if ($erreur_reference!=false){
                    echo $erreur_reference;
                    }
                    ?>
               
            </div>



                <!--Ajouter une description au matériel-->
                <div id="description">
    
                    <p>Description : </p>
                    <textarea id="champs" type="text" name="description" size="10" required="required"></textarea>
                <?php
                $erreur_description=description(); // erreur de noms 
                if ($erreur_description!=false){
                echo $erreur_description;
                }
                ?>
                </div> 
            </div>
            <br>
            <br>



                    <!--Bouton pour ajouter le matériel à la BDD-->
            <div id="div_boutton">
                <button type="submit" id="boutton_ajout">Ajouter nouveau matériel</button>
            </div>
        </div>
    </form>
    </div> <!--Fin du Formulaire-->




                <!--Code qui permet d'ajouter le matériel-->
    <?php



        $mail = $_SESSION['mail'];
        

        //Définir les matériels et ne pas pouvoir les modifier
        define('ALLOWED_TYPES', ['camera', 'Trépied', 'micro', 'light']);



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



mysqli_close($link);

    ?>
</body>
</html>