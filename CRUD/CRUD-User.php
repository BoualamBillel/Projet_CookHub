<?php

// Connexion à la base de données
function connectDatabase()
{
    $host = '127.0.0.1';
    $db = 'app-database';
    $user = 'root';
    $password = 'root';

    try {
        $database = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        return null;
    }
}

// Fonction pour créer un utilisateur

function createUser($username, $email, $password)
{
    // Vérification de la connexion à la base de données
    $database = connectDatabase();
    if ($database === null) {
        return false;
    }
    // Préparation de la requête d'insertion
    $request = $database->prepare("INSERT INTO CookHub_users (username, email, password) VALUES (:username, :email, :password)");
    // Exécution de la requête avec les paramètres fournis
    $isSuccess = $request->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_BCRYPT) // Hashage du mot de passe
    ]);
    // Vérification si l'insertion a réussi
    if ($isSuccess) {
        $user_id = $database->lastInsertId(); // Stocke l'ID de l'utilisateur créé
    } else {
        return false; // Retourne false en cas d'échec
    }
    return $user_id; // Retourne l'ID de l'utilisateur créé dans la variable $user_id

}

// Fonction pour récupérer un utilisateur par ID
function getUserByID ($user_id) {
    // Vérification de la connexion à la base de données
    $database = connectDatabase();
    if ($database === null) {
        return false;
    }
    // Préparation de la requête pour récupérer l'utilisateur par ID
    $request = $database->prepare("SELECT * FROM CookHub_users WHERE id = :id");
    // Exécution de la requête avec l'ID fourni
    $request->execute([':id' => $user_id]);
    // Récupération des données de l'utilisateur
    $user = $request->fetch(PDO::FETCH_ASSOC);
    
    return $user; // Retourne les données de l'utilisateur
}

// Fonction pour récupérer un utilisateur par son email
function getUserByEmail($email) {
    // Vérification de la connexion à la base de données
    $database = connectDatabase();
    if ($database === null) {
        return false;
    }
    // Préparation de la requête pour récupérer l'utilisateur par email
    $request = $database->prepare("SELECT * FROM CookHub_users WHERE email = :email");
    // Exécution de la requête avec l'email fourni
    $request->execute([':email' => $email]);
    // Récupération des données de l'utilisateur
    $isSuccess = $request->fetch(PDO::FETCH_ASSOC);
    if ($isSuccess) {
        $SuccessMessage = "L'utilisateur a été trouvé avec succès.";
        return $isSuccess; // Retourne les données de l'utilisateur
    } else {
        $ErrorMessage = "L'utilisateur n'existe pas.";
        return false; // Retourne false si l'utilisateur n'existe pas
    }
    

}

