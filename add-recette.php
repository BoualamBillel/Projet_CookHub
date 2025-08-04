<?php
session_start(); // Démarre la session pour gérer les connexions des utilisateurs
require_once 'CRUD/CRUD-Recettes.php'; // Inclusion du fichier CRUD-Recettes
require_once 'CRUD/CRUD-User.php'; // Inclusion du fichier CRUD-User pour accéder aux fonctions de gestion des utilisateurs
connectDatabase(); // Connexion à la base de données
var_dump($_SESSION); // Débogage pour vérifier les données de session

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}
$user_id = $_SESSION['user_id']; // Récupération de l'ID de l'utilisateur depuis la session

// Vérification si le formulaire a été soumis
if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['ingredients']) && isset($_POST['cooking_time'])) {
    // Récupération des données du formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $cooking_time = $_POST['cooking_time'];

    // Appel de la fonction createRecette pour ajouter une nouvelle recette
    $recette_id = createRecette($title, $description, $ingredients, $cooking_time, $user_id);

    // Vérification si la recette a été ajoutée avec succès
    if ($recette_id) {
        echo "Recette ajoutée avec succès. ID de la recette : " . $recette_id;
        header('Location: espace-user.php'); // Redirection vers l'espace utilisateur après ajout réussi
        exit();
    } else {
        echo "Erreur lors de l'ajout de la recette.";
    }
}
// Débogage
var_dump($_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Recette</title>
</head>
<body>
    <h1>Ajouter une Recette</h1>
    <form action="add-recette.php" method="post">
        <label for="title">Titre:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description"><br>
        <label for="ingredients">Ingrédients:</label>
        <textarea id="ingredients" name="ingredients" required></textarea><br>
        <label for="cooking_time">Temps de cuisson:</label>
        <input type="text" id="cooking_time" name="cooking_time" required><br>
        <button type="submit">Ajouter la recette !</button>