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
       <div class="form_txt">Mail :</div>   <input type="text" name="mail">
       <div class="form_txt">Mot de passe :</div>   <input type="text" name="mdp">
        </div>
        <input type="submit" value="Se connecter">
    </form>

    <?php
    
    if (!empty($_POST['mail']) && !empty($_POST['mail'])) {
    $mail = $_POST ['mail'];
    $mpd = $_POST ['mdp'];
    }
    else {
    echo "t une merde";
    }
    
    ?>

</body>
</html>