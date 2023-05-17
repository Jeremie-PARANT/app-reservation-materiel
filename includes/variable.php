<?php
//     -----    BASE DE DONNEE   -----     //
$link = mysqli_connect("localhost", "root", "", "sae_203");

//select session autorisation
$mail = $_SESSION['mail'];
$result_autorisation = mysqli_query($link, "SELECT autorisation FROM utilisateurs WHERE mail='$mail'"); //enlever quand connexion ok
$row_autorisation = mysqli_fetch_array($result_autorisation); //enlever quand connexion ok
$autorisation = $row_autorisation['autorisation']; //enlever quand connexion ok

//     -----    BASE DE DONNEE   -----     //

//recupere URL
$url = $_SERVER['REQUEST_URI'];