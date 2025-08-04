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
        <div class="card">
            <h2><?= $recette['title']?></h2>
            <div class="infos">
                <p><?= $recette['cooking_time']?></p>
                <p><?= $recette['ingredients']?></p>
            </div>
            <p><?= $recette['description']?></p>
        </div>
    </main>
    <footer>
        <a href="index.php">Retour</a>
    </footer>
</body>
</html>