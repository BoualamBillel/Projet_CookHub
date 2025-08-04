<?php
require_once 'CRUD/CRUD-User.php'; // Inclusion du fichier CRUD-User.php pour accéder aux fonctions de gestion des utilisateurs
connectDatabase(); // Connexion à la base de données
session_start(); // Démarre la session pour gérer les sessions utilisateur

// Vérification si le formulaire a été soumis
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Appel de la fonction getUserByEmail pour récupérer l'utilisateur
    $user = getUserByEmail($email);
    var_dump($user); // Affichage des données de l'utilisateur pour débogage

    // Vérification si l'utilisateur existe
    if ($user) {
        // Vérification du mot de passe
        if (password_verify($password, $user['password'])) {
            echo "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['username']);
            $_SESSION['user_id'] = $user['id']; // Stocke l'ID de l'utilisateur dans la session     
            header('Location: index.php'); // Redirection vers la page d'accueil après connexion réussie
            exit(); // Termine le script pour éviter d'exécuter du code supplémentaire

        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a></p>
</body>
</html>
