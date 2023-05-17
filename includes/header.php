<style>
header {
    position: sticky;
    display: flex;
    justify-content: center;
    height: 50px;
    background-color: #09A491;
}
.img3 {
    margin-left: 30px;
    margin-top: 10px;
    padding-right : 10px;
    padding-left : 10px;
    width : 30px;
    height : 30px;

}
.reservation {
    
    margin-top: 10px;
    margin-left: 1160px;
    padding-right : 10px;
    padding-left : 10px;
    color: white;
    font-size: 25px;
    font-weight: 700;
    transition: all 0.5s ease-out ;
}

.reservation:hover,
.reservation:focus {
  color: #333;
  background-color: #fff;
  border-radius: 30px;
}

.materiel{
    
    margin-top: 10px;
    margin-left: 20px;
    padding-right : 10px;
    padding-left : 10px;
    color: white;
    font-size: 25px;
    font-weight: 700;
    transition: all 0.5s ease-out ;
}

.materiel:hover,
.materiel:focus {
  color: #333;
  background-color: #fff;
  border-radius: 30px;
}

a {
    text-decoration: None;
}

</style>

<header> 
    <a href="materiel.php"><div class="materiel">Materiel</div></a>
    <a href="reservation.php"><div class="reservation">Réservation</div></a>
    <a href="connexion.php" > <img src="SAE_203/images/avatar.png" class="img3"/></a>
   
    
</header>