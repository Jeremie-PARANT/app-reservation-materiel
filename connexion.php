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
    <form method="post">
        <div class="form_block">
       <div class="form_txt">Mail :</div><input type="text">
       <div class="form_txt">Mot de passe :</div><input type="text">
        </div>
        <input type="submit" value="Se connecter">
    </form>

<?php 

include_once('includes/header_authentication.php'); 



?>

</body>
</html>