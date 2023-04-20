<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/inscription.css">
    <title>Document</title>
</head>

<body>
    <?php include_once('includes/header_authentication.php'); ?>
    <?php include_once('includes/fonction.php'); ?>
    <form action="inscription.php" method="post">
        <div class="form_bloc">
            <span class="form_txt">Prénom :</span>
            <input type="text" name="prenom" required="required">
            <?php prenom($_POST['prenom']); //vérifie erreur de prenom ?>
            <span class="form_txt">Nom :</span>
            <input type="text" name="nom" required="required">
            <?php nom($_POST['nom']); //vérifie erreur de nom ?>
            <span class="form_txt">Date de naissance :</span>
            <input type="date" name="naissance" required="required">
            <?php naissance($_POST['naissance']); //vérifie erreur de naissance ?>
            <span class="form_txt">Email :</span>
            <input type="text" name="mail" required="required">
            <?php email($_POST['mail']); //vérifie erreur de email ?>
            <span class="form_txt">Mot de passe :</span>
            <input type="password" name="mdp" required="required">
            <?php mdp($_POST['mdp']); //vérifie erreur de email ?>
            <input type="submit">
        </div>
    </form>
    <?php
    if (prenom() == true && nom() == true && naissance() == true && email() == true && mdp() == true) {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $naissance = $_POST['naissance'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        echo 'vous etes inscript';
        $link = mysqli_connect("localhost", "root", "", "sae_203");
        $query = "INSERT INTO utilisateurs(prenom, nom, naissance, mdp, mail) VALUES ('$prenom', '$nom', '$naissance', '$mdp', '$email')";
        mysqli_query($link, $query);
    }
    ?>

</body>

</html>