<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css">
    <title>Document</title>
</head>
<body>
<?php 
include_once('includes/header_authentication.php'); 
?>
    <form action="connexion.php" method="post">
        <div class="form_block">
       <div class="form_txt">Mail :</div>   
       <input type="text" name="mail" required="required">
       <div class="form_txt">Mot de passe :</div>   
       <input type="text" name="mdp" required="required">
        </div>
        <input type="submit" value="Se connecter">
    </form>

    <?php
   
session_start();

   $link = mysqli_connect("localhost", "root", "", "sae_203");

   if (!empty($_POST['mail']) && !empty($_POST['mdp'])) {
       $mail = $_POST['mail'];
       $mdp = $_POST['mdp'];
       $result = mysqli_query($link, "SELECT mail, mdp FROM utilisateurs WHERE mail='$mail'");
       $row = mysqli_fetch_assoc($result);
       if ($row && $row['mail'] == $mail && $row['mdp'] == $mdp) {
            $_SESSION['mail'] = $mail;
            header("location: materiel.php");
           
       } else {
           echo "Mail ou mot de passe incorrect";
       }
   }
   
   
    ?>

</body>
</html>