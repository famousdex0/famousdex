<?php
header('Content-Type: application/json');

$connexion = new mysqli("localhost", "root", "", "entreprise");

if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

$requete = '
    SELECT code_user, nom, prenom, email, fonction, service FROM directeur 
    UNION 
    SELECT code_user, nom, prenom, email, fonction, service FROM agent
    UNION 
    SELECT code_user, nom, prenom, email, fonction, service FROM respo
    UNION 
    SELECT code_user, nom, prenom, email, fonction, service FROM technicien
';

$resultat = $connexion->query($requete);

$users = array();

if ($resultat->num_rows > 0) {
    while($row = $resultat->fetch_assoc()) {
        $users[] = $row;
    }
}

$connexion->close();

echo json_encode($users);
?>
