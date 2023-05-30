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


    <div class="inscription">Inscription</div>


    <?php include_once('includes/fonction.php'); 
    include_once('includes/variable.php'); 
    ?>

    <form action="inscription.php" method="post">

    <div class="form_bloc">

        <div id=prenom>

        <span class="form_prenom">Prénom :
        <input id=p type="text" name="prenom" required="required">
        </span>

        <?php $erreur_prenom=prenom(); // erreur de prenom
        if ($erreur_prenom!=false){
            echo $erreur_prenom;}?>


        <span class="form_nom">Nom :
        <input id=n type="text" name="nom" required="required">
        </span>


        <?php $erreur_nom=nom(); // erreur de nom 
        if ($erreur_nom!=false){
            echo $erreur_nom;}?>

        </div>

        <div id= date>

        <span class="form_date">Date de naissance :
        <input id=d type="date" name="naissance" required="required">
        </span>

        <?php $erreur_naissance=naissance(); // erreur de naissance 
        if ($erreur_naissance!=false){
            echo $erreur_naissance;}?>
        
        <span class="form_email">Email :
        <input id=e type="text" name="email" required="required">
        </span>
        
        </div>

       <?php $erreur_email=email(); // erreur de email 
        if ($erreur_email!=false){
            echo $erreur_email;}?>

        <div id=mdp>
        
        <span class="form_mdp">Mot de passe :
        <input id=m type="password" name="mdp" required="required">
        </span>
        
        </div>

        <?php $erreur_mdp=mdp(); // erreur de mdp 
       if ($erreur_mdp!=false){
            echo $erreur_mdp;}?>

        <input type="submit" value="S'inscrire" class="bouton">
    
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
                    header("location: index.php");
                }
            }
        }
    ?>
    
    <?php include_once('includes/footer.php'); ?>
    
</body>

</html>