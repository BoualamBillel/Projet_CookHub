<?php
session_start();
require_once 'CRUD/CRUD-User.php';
require_once 'CRUD/CRUD-Recettes.php';// Inclusion du fichier CRUD-User.php pour accéder aux fonctions de gestion des utilisateurs
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$user_id = $_SESSION['user_id']; // Récupération de l'ID de l'utilisateur depuis la session // Récupération des données de l
$recette = get_all_recette_by_user($user_id);
$user = getUserByID($user_id); // Récupération des données de l'utilisateur

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>affichage</title>
</head>
<body>
        <h3>Welcome <?= htmlspecialchars($user['username']) ?></h3>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <?php if ($recette): ?>
        <h1>Mes Recettes</h1>
        <ul>
            <?php foreach ($recette as $r): ?>
                <li><?php echo htmlspecialchars($r['title']); ?> - <?php echo htmlspecialchars($r['description']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune recette trouvée.</p>
    <?php endif; ?>



<header>

<a href="index.php">Accueil</a>
<a href="logout.php">Se déconnecter</a>
<a href="espace-user.php">Mon Espace Utilisateur</a>
<a href="add-recette.php">Ajouter une Recette</a>

</header>   

</body>
</html>