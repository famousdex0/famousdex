<?php
session_start();

// Détruire la session
session_unset();
session_destroy();

// Supprimer les cookies
setcookie("email", "", time() - 3600, );
setcookie("password", "", time() - 3600, );

// Rediriger vers la page de connexion
header("Location: pages-login.php");
exit;
?>
