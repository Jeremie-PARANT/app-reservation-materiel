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
   
    
    if (!empty($_POST['mail']) && !empty($_POST['mdp'])) {
    $mail = $_POST ['mail'];
    $mpd = $_POST ['mdp'];
    }
    else {
    echo "t une merde";
    }


    try{
    $db = new PDO(
        'mysql:host=localhost;dbname=sae_203;charset=utf8','root'
    );
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    die(print_r($e));
}
$result = $db->query("SELECT mail FROM utilisateurs");
$resultmdp = $db->query("SELECT mdp FROM utilisateurs");
while ($data = $result->fetch()){
if ($_POST ['mail']== $result && $_POST ['mdp'] == $resultmdp );
echo "vous etes connecté";
}
    
    ?>

</body>
</html>