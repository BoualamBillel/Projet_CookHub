<?php
session_start(); // Démarre la session pour gérer les connexions des utilisateurs
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session
header('Location: login.php'); // Redirection vers la page de connexion
exit(); // Termine le script