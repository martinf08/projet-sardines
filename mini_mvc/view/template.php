<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <!-- Header -->
        <div id="menu-burger">Menu</div>
        <h1><?= $title ?></h1>
    </header>

    <?= $content ?>

    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>