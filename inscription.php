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
        <?php nom($_POST['nom']); //vérifie erreur de prenom ?>
        <div class="form_txt">Date de naissance :</div><input type="date" name="naissance">
        <?php naissance($_POST['naissance']); //vérifie erreur de prenom ?>
        <div class="form_txt">Email :</div><input type="text" name="email">
        <div class="form_txt">Mot de passe :</div><input type="password" name="mdp">
        </div><input type="submit">
    </div>
    </form>
    <?php
    /*
    if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['naissance']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
        $prenom = $_POST['prenom'] ;
        $nom = $_POST['nom'] ;
        $naissance = $_POST['naissance'] ;
        $email = $_POST['email'] ;
        $mdp = $_POST['mdp'] ;
        echo "vide";
    }
    */
    ?>
</body>
</html>