<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
    <header>
        <!-- Header -->
        <?php 
        # je ne l'include pas tout de suite parce que les variables de session ne sont pas encore en place
        #include_once 'inc/_menu.php'; ?>
        <h1><?= $title ?></h1>
    </header>

    <?= $content ?>

    <footer>
        <!-- Footer -->
    </footer>
</body>

<script src="js/verif_form.js"></script>
</html>