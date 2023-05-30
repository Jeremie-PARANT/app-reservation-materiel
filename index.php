<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/connexion.css">
    <title>Document</title>
</head>
<body>

<?php 
include_once('includes/header_authentication.php'); 
include_once('includes/variable.php');
?>

<div class="connection">Connexion</div>
    <form action="index.php" method="post">



        <div class="form_block">
        <div id="co">

       <span class="form_email">Email :   
       <input id=e type="text" name="mail" required="required"></span>
       
       <span class="form_mdp">Mot de passe :  
       <input id=m type="password" name="mdp" required="required"></span> 
        </div>
        <input id="b_connexion" type="submit" value="Se connecter">
         
        </div>
    </form>

   <a href="inscription.php"> <input id="b_inscription" type="submit" value="S'inscrire"> </a>


    <?php
   
session_start();




   if (!empty($_POST['mail']) && !empty($_POST['mdp'])) {
       $mail = $_POST['mail'];
       $mdp = $_POST['mdp'];
       $result = mysqli_query($link, "SELECT mail, mdp, autorisation FROM utilisateurs WHERE mail='$mail'");
       $row = mysqli_fetch_assoc($result);
       if ($row && password_verify($mdp, $row['mdp'])) {
            $_SESSION['mail'] = $mail;
            $_SESSION['autorisation'] = $row['autorisation'];
            if ($row['autorisation'] == '1') {
                header('Location: new_materiel.php');
            }
            else{
                header("Location: materiel.php");
            }
           exit();
       } else {
           echo "Mail ou mot de passe incorrect";
       }
    
   }
    ?>
    <?php include_once('includes/footer.php'); ?>

</body>
</html>