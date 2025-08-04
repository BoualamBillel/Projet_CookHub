<?php 
require_once 'CRUD/CRUD-User.php';
session_start();

if (isset($_POST["email"]) && 
    isset($_POST["password"])){

    // $user = get_user($_POST["email"]);
    if (password_verify($_POST["password"], $user["password"])
    
    ) {
        $_SESSION["email"] = $user["email"];
        header("Location: index.php");
    } else {
        $error = "Login incorrect";
    }
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CookHub</title>
</head>
<body>

    <main>
    <h2>Connection</h2>
    <form action="" method="post">
        <input type="text" name="email" placeholder="Votre E-mail">
        <input type="password" name="password" placeholder="Votre mot de passe">
        <button>Se connecter</button>
    </form>
    <a href="inscription.php">Pas de compte ? Voulez-vous vous s'inscrire ?</a>
    </main>
</body>
</html>