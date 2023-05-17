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
        <div class="form_txt">Prénom :</div><input type="text" name="prenom" required="required">
        <?php $erreur_prenom=prenom(); // erreur de prenom
        if ($erreur_prenom!=false){
            echo $erreur_prenom;}?>
        <div class="form_txt">Nom :</div><input type="text" name="nom" required="required">
        <?php $erreur_nom=nom(); // erreur de nom 
        if ($erreur_nom!=false){
            echo $erreur_nom;}?>
        <div class="form_txt">Date de naissance :</div><input type="date" name="naissance" required="required">
        <?php $erreur_naissance=naissance(); // erreur de naissance 
        if ($erreur_naissance!=false){
            echo $erreur_naissance;}?>
        <div class="form_txt">Email :</div><input type="text" name="email" required="required">
        <?php $erreur_email=email(); // erreur de email 
        if ($erreur_email!=false){
            echo $erreur_email;}?>
        <div class="form_txt">Mot de passe :</div><input type="password" name="mdp" required="required">
        <?php $erreur_mdp=mdp(); // erreur de mdp 
        if ($erreur_mdp!=false){
            echo $erreur_mdp;}?>
        <input type="submit">
    </div>
    </form>
    <br/>
    <?php  //envoie vers BDD
        $link = mysqli_connect("localhost","root","","sae_203") ;
        if (prenom()==false && nom()==false && naissance()==false && email()==false && mdp()==false) {
            if (!empty($_POST['prenom']) OR !empty($_POST['nom']) OR !empty($_POST['naissance']) OR !empty($_POST['email']) OR !empty($_POST['mdp'])) {
            $prenom = mysqli_real_escape_string($link, $_POST['prenom']);
            $nom = mysqli_real_escape_string($link, $_POST['nom']);
            $naissance = mysqli_real_escape_string($link, $_POST['naissance']);
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $mdp = mysqli_real_escape_string($link, $_POST['mdp']);
            $hashedPassword = mysqli_real_escape_string($link, password_hash($mdp, PASSWORD_DEFAULT));
            
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
        }
    ?>
    <?php include_once('includes/footer.php'); ?>
</body>

</html>