<?php
include_once "login.php";

// Récupération du code de confirmation depuis l'URL
$code_confirmation = $_GET['code_confirmation'];

// Vérification du code de confirmation dans la base de données
$connexion = new mysqli("localhost", "root", "", "entreprise");

if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

$requete = "SELECT * FROM inscription WHERE code_confirmation = '$code_confirmation'";
$resultat = $connexion->query($requete);

if ($resultat->num_rows == 1) {
    // Marquer l'utilisateur comme confirmé dans la base de données
    $row = $resultat->fetch_assoc();
    $id_utilisateur = $row['id'];
    
    $update_requete = "UPDATE inscription SET confirme = 1 WHERE id = $id_utilisateur";
    $connexion->query($update_requete);
    
    echo "<p> Votre inscription a été confirmée avec succès. Vous pouvez maintenant creer votre mot de passe.</p>";
    
} else {
    echo "Code de confirmation invalide.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
<style>
    p{color: White;}
</style>
