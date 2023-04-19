<!DOCTYPE html>
<html lang="en">
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
        <div class="form_txt">Prénom :</div><input type="text" name="prenom">
        <?php prenom($_POST['prenom']); //vérifie erreur de prenom ?>
        <div class="form_txt">Nom :</div><input type="text" name="nom">
        <?php nom($_POST['nom']); //vérifie erreur de nom ?>
        <div class="form_txt">Date de naissance :</div><input type="date" name="naissance">
        <?php naissance($_POST['naissance']); //vérifie erreur de naissance ?>
        <div class="form_txt">Email :</div><input type="text" name="email">
        <?php email($_POST['email']); //vérifie erreur de email ?>
        <div class="form_txt">Mot de passe :</div><input type="password" name="mdp">
        <?php mdp($_POST['mdp']); //vérifie erreur de email ?>
        <input type="submit">
    </div>
    </form>
    <?php
        if (prenom()==true && nom()==true && naissance()==true && email()==true && mdp()==true) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $naissance = $_POST['naissance'];
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];
            echo 'vous etes inscript';
            $link = mysqli_connect("localhost","root","","temp") ;
            $query = "INSERT INTO utilisateurs(prenom, nom, naissance, mdp, mail) VALUES ('$prenom', '$nom', '$naissance', '$mdp', '$email')";
            mysqli_query($link, $query);
        }
    ?>
    <?php include_once('includes/header_authentication.php'); ?>
</body>
</html>