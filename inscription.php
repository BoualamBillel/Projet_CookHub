<?php 
require_once 'CRUD/CRUD-User.php'; // Inclusion du fichier CRUD-User.php pour accéder aux fonctions de gestion des utilisateurs
connectDatabase(); // Connexion à la base de données

// Vérification si le formulaire a été soumis
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Appel de la fonction createUser pour créer un nouvel utilisateur
    $user_id = createUser($username, $email, $password);

    // Vérification si l'utilisateur a été créé avec succès
    if ($user_id) {
        echo "Utilisateur créé avec succès. ID de l'utilisateur : " . $user_id;
        header('Location: login.php'); // Redirection vers la page de connexion après inscription réussie
    } else {
        echo "Erreur lors de la création de l'utilisateur.";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="inscription.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">S'inscrire</button>
    </form>

    
</body>
</html>