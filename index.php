<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

require_once('CRUD/CRUD_user.php');

$recettes = get_all_recette_by_user_id($_SESSION['user_id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <main>
        <div class="list_recipe">
            <?php foreach($recettes as $recette):?>
                <div class="card_recipe">
                    <div class="recipe_description">
                        <div class="recipe_ingredrients">
                            <p>
                                <?= $recette['ingredients']?>
                            </p>
                        </div>
                        <div class="recipe_infos">
                            <h2>
                                <?= $recette['title']?>
                            </h2>
                            <p>
                                <?= $recette['cooking_time']?>
                            </p>
                            <p>
                                ID : <?= $recette['user_id']?>
                            </p>
                        </div>
                    </div>
                    <a href="show-recipe.php?id=<?= $recette['id']?>"></a>
                </div>
            <?php endforeach?>
        </div>
    </main>
    <footer>
        <div class="logout"></div>
    </footer>
</body>
</html>