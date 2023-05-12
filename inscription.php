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
        <div class="form_txt">Prénom :</div><input type="text" name="prenom">
        <?php prenom(); // erreur de prenom ?>
        <div class="form_txt">Nom :</div><input type="text" name="nom">
        <?php nom(); // erreur de nom ?>
        <div class="form_txt">Date de naissance :</div><input type="date" name="naissance">
        <?php naissance(); // erreur de naissance ?>
        <div class="form_txt">Email :</div><input type="text" name="email">
        <?php email(); // erreur de email ?>
        <div class="form_txt">Mot de passe :</div><input type="password" name="mdp">
        <?php mdp(); // erreur de email ?>
        <input type="submit">
    </div>
    </form>
    <br/>
    <?php
        if (prenom()==true && nom()==true && naissance()==true && email()==true && mdp()==true) {
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $naissance = htmlspecialchars($_POST['naissance']);
            $email = htmlspecialchars($_POST['email']);
            $mdp = htmlspecialchars($_POST['mdp']);
            
            $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
            
            $link = mysqli_connect("localhost","root","","sae_203") ;
            
            $querymail = "SELECT mail FROM utilisateurs WHERE mail='".$email."'";
            $checkmail = mysqli_query($link, $querymail);
                
            if (mysqli_num_rows($checkmail) != 0) {
                    echo '<div class="erreur"> email déjà utilisé </div>';
                }
                else {
                    $query = "INSERT INTO utilisateurs(prenom, nom, naissance, mdp, mail) VALUES ('$prenom', '$nom', '$naissance', '$hashedPassword', '$email')";
                    mysqli_query($link, $query);
                    echo 'vous etes inscrits';
                    header("location: connexion.php");
                }

        }
    ?>

</body>

</html>