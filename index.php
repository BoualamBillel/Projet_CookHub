<?php
session_start(); // Démarre la session pour gérer les connexions des utilisateurs
require_once 'CRUD/CRUD-User.php'; // Inclusion du fichier CRUD-User.php pour accéder aux fonctions de gestion des utilisateurs
// Vérification si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Récupération de l'ID de l'utilisateur depuis la session
    $user = getUserByID($user_id); // Récupération des données de l'utilisateur
    if ($user) {
        echo "Bienvenue, " . htmlspecialchars($user['username']) . "!"; // Affichage du nom d'utilisateur
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "Vous n'êtes pas connecté. Veuillez vous <a href='login.php'>connecter</a> ou vous <a href='inscription.php'>inscrire</a>."; // Message si l'utilisateur n'est pas connecté
}   

// debogage
var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Page d'accueil</h1>
    <p>Bienvenue sur la page d'accueil de CookHub!</p>
    <a href="logout.php">Se déconnecter</a> <!-- Lien pour se déconnecter -->
    
</body>
</html>