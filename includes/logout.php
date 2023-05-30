<?php
session_start(); // Si vous utilisez des sessions

if (isset($_SESSION['utilisateurs'])) {
    session_unset();
    session_destroy();
    // Autres opérations de déconnexion spécifiques à votre application
}

header("Location: ../index.php");
exit();
?>
