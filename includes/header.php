<style>
*{
margin: 0;
padding: 0;
}


header {

    position: sticky;
    display: flex;
    justify-content: center;
    height: 50px;
    background-color: #09A491;
    width: 100%;

}
.img3 {
margin-left: 30px;
margin-top: 10px;

width : 30px;
height : 30px;

}
.reservation {

margin-top: 10px;
margin-left: 50px;
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

.reservation_list{

margin-top: 10px;
margin-left: 20px;
padding-right : 10px;
padding-left : 10px;
color: white;
font-size: 25px;
font-weight: 700;
transition: all 0.5s ease-out ;
}

.reservation_list:hover,
.reservation_list:focus {
color: #333;
background-color: #fff;
border-radius: 30px;
}

.ajouter{

margin-top: 10px;
margin-left: 20px;
padding-right : 10px;
padding-left : 10px;
color: white;
font-size: 25px;
font-weight: 700;
transition: all 0.5s ease-out ;
}

.ajouter:hover,
.ajouter:focus {
color: #333;
background-color: #fff;
border-radius: 30px;
}

a {
text-decoration: None;
}

#menu {
margin-top: 6px;

}

#menu-item {
background-color: #09A491;
text-align: center;
color: white;
height: 30px;
width: 200px;
font-size: 30px;
padding-bottom: 5px;
transition: all, 0.5s;
display: block;
}

#transition {
height: 47px;
background-color: #09A491;

overflow: hidden;
transition: all, 1s;
}

#transition:hover {
height: 84px;
}

.menu-item:hover {
color: black;

background-color: white;
}

.bouton{
  padding: 0;
  border: none;
  background: none;
  font-size: 25px;
  color: white;
}

</style>

<header> 
    
<a href="materiel.php"><div class="materiel">Materiel</div></a>

<?php
     include_once('includes/variable.php');
     if (!empty ($autorisation) && $autorisation==1){
        echo '<a href="new_materiel.php"><div class="ajouter">Ajouter Materiel</div></a>';
     }
?>

<a href="reservation.php"><div class="reservation">Réservation</div></a>
<a href="reservation_liste.php"><div class="reservation_list">Liste de Réservation</div></a>

<div id='transition'>
<img src="images/avatar.png" class="img3"/> 
        <div id='menu'> 
    <div id="menu-item">
      <form action="includes/logout.php" method="post">
        <input type="submit" class="bouton" value="Déconnexion">
      </form>
    </div> 
    </div>
</div> 



</header>