<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/new_materiel2.css">
    <title>Ajouter du matériel</title>
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
                </div>
                <div id="description">




                    <!--Ajouter une description au matériel-->
                    <p>Description : </p>
                    <textarea id="champs" type="text" name="description" size="10" required="required"></textarea>
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



        //définir la réference
        if (!empty($_POST['reference'])){
            $reference = ($_POST['reference']);


            //vérif des autorisations et references
        $query = "SELECT autorisation FROM utilisateurs WHERE mail='$mail' ;" ;
        $queryref = "SELECT reference FROM materiels WHERE reference='".$reference."'";
        $checkref = mysqli_query($link, $queryref);



            //Message si Réference déjà utilisé
         if (mysqli_num_rows($checkref) != 0) {
                    echo '<div class="erreur"> Reference déja transmise </div>';
         }


         //message si le type est faux
        elseif (!empty($_POST['type'])) {
            if (!in_array($_POST['type'], ALLOWED_TYPES)) {
                echo "type faux";
            }
        }


        //Envoi des infos à la BDD
        else{
        $result = mysqli_query($link, $query) ;
        while ($row = mysqli_fetch_assoc($result)) {

            //Vérif des autorisations
            if ($row['autorisation'] == '1') {
                if (!empty($_POST['nom']) && !empty($_POST['reference']) && !empty($_POST['type']) && !empty($_POST['description'])) {

                    //msqli_real_escape_strings évite injections de code pour la BDD
                    $nom =  mysqli_real_escape_string($link, $_POST['nom']) ;
                    $reference = mysqli_real_escape_string($link, $_POST['reference']) ;
                    $type = mysqli_real_escape_string($link, $_POST['type']) ;
                    $description = mysqli_real_escape_string($link, $_POST['description']) ;

                    //Insertion du matériel
                    $query = "INSERT INTO materiels (reference, nom, type, description) VALUES ('$reference', '$nom', '$type', '$description') ;" ;    
                    mysqli_query($link, $query) ;

                    //Message d'ajout
                    echo "Votre matériel a bien été ajouté";
                       
                }
            }
        }
        }
    }

        mysqli_close($link);
    ?>
</body>
</html>