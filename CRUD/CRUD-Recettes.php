<?php

function connect_database() : PDO {
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database","root", "root");
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database;
}


// Fonction pour récupérer UNE recette par son identifiant
function get_recette($id): array {
    // Connexion à la base de données via une fonction externe
    $database = connect_database();  
    
    // Préparation de la requête SQL pour éviter les injections
    $prepare = $database->prepare('SELECT * FROM Cookhub_recettes WHERE id = ?');  

    // Exécution de la requête avec l'identifiant passé en paramètre
    $prepare->execute([$id]);

    // Récupération d'une seule ligne de résultat sous forme de tableau associatif
    $recette = $prepare->fetch(PDO::FETCH_ASSOC);

    // Si aucune recette trouvée, retourne null
    if (!$recette) {
        return null;
    }

    // Sinon, retourne la recette trouvée
    return $recette;
}



function createRecette($title, $description, $ingredients, $cooking_time, $user_id) {
    // Connexion à la base de données
    $database = connect_database();

    // Préparation de la requête d'insertion
    $prepare = $database->prepare('INSERT INTO CookHub_recettes (title, description, ingredients, cooking_time, user_id) VALUES (:title, :description, :ingredients, :cooking_time, :user_id)');

    // Exécution de la requête avec les paramètres fournis
    $isSuccessful = $prepare->execute([
        ':title' => $title,
        ':description' => $description,
        ':ingredients' => $ingredients,
        ':cooking_time' => $cooking_time,
        ':user_id' => $user_id
    ]);
    // Si l'insertion a réussi affiche une message de succès
    if ($isSuccessful) {
        // Retourne l'ID de la recette créée
        return $database->lastInsertId();
        echo "Recette ajoutée avec succès. ID de la recette : " . $database->lastInsertId();
    }
}
// Fonction pour récupérer TOUTES les recettes associées à un utilisateur donné
function get_all_recette_by_user($user_id): array {
    // Connexion à la base de données
    $database = connect_database();

    // Préparation de la requête pour sélectionner toutes les recettes de l'utilisateur
    $prepare = $database->prepare('SELECT * FROM CookHub_recettes WHERE user_id = ?');

    // Exécution avec l'identifiant utilisateur
    $prepare->execute([$user_id]);

    // Retourne toutes les recettes correspondantes sous forme de tableau de tableaux associatifs
    return $prepare->fetchAll(PDO::FETCH_ASSOC);
    return $recettes ?: null;

}



// Fonction qui convertit un temps de cuisson (en minutes) en une chaîne lisible (ex: "1 heure(s) et 30 minute(s)")
function cooking_time_to_string(int $cooking_time): string {
    
    // Calcule le nombre d'heures entières dans le temps total
    $hours = floor($cooking_time / 60);
    
    // Calcule le reste en minutes après avoir retiré les heures
    $minutes = $cooking_time % 60;

    // Formate la chaîne selon qu'il y ait des heures ou non
    if ($hours > 0) {
        // Si le temps est d'au moins 1 heure, affiche "X heure(s) et Y minute(s)"
        return sprintf('%d heure(s) et %d minute(s)', $hours, $minutes);
    } else {
        // Sinon, affiche simplement "Y minute(s)"
        return sprintf('%d minute(s)', $minutes);
    }
}



function delete_recette($id) {
    $database = connect_database();
    $prepare = $database->prepare('DELETE FROM CookHub_recettes WHERE id = ?');
    $isSucessful = $prepare->execute([$id]);
    if ($isSucessful) {
        return false; // Retourne true si la suppression a réussi
    }
    return $isSucessful; // Retourne false si la suppression a échoué
}

