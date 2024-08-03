<?php 
session_start();
// Vérifiez si l'ID de l'élément à supprimer est passé en tant que méthode POST
if (isset($_POST['id'])) {
    // Récupérez l'ID de l'élément
    $id = $_POST['id'];

    // Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "", "entreprise");

    // Échappez l'ID de l'élément pour éviter les injections SQL
    $id = $connexion->real_escape_string($id);

    // Requête pour supprimer l'élément de la base de données
    $query = "DELETE FROM tache WHERE id = '$id'";
    $result = $connexion->query($query);
       
    // Vérifiez si la suppression a réussi
    if ($result) {
        // Répondez avec un statut de succès
        http_response_code(200);
    header("Location: pages-tache-admin.php");    
     exit();
    }
}

