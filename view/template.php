<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/cheatsheet.css">
    <link rel="stylesheet" href="css/insert-test.css">
    <link rel="stylesheet" href="css/header.css"><!-- contient simplement les classes pour position et effet tiroir -->
    <link rel="stylesheet" href="css/cheatsheet.css">
    <link rel="stylesheet" href="css/insert-asset.css">
    <?php if (isset($css)): # passer du css depuis le controller (changer ça en boucle s'il faut) ?>
        <link rel="stylesheet" href="css/<?= $css ?>.css">
    <?php endif; ?>
</head>
<body>
    <?php
    # à nettoyer quand plus besoin
    #debug($_SESSION);
    ?>

    <header>
        <!-- Header -->
        <div id="close"><!-- fermeture du menu -->
            <div class="cross"></div>
        </div>

        <div id="display-user" style="background: #eee;"><!-- ici l'affiche des infos de l'user connecté -->
            <?php if(isset($_SESSION['user']) AND !empty($_SESSION['user'])): ?>
                <div id="avatar">ici sa photo</div>
                <p id="pseudo"><?php echo $_SESSION['user']->getNickname(); ?></p>
                <p id="mail"><?php echo $_SESSION['user']->getEmail(); ?></p>
                <p id="user-id">ID : <?php echo strtoupper($_SESSION['user']->getIdentifier()); ?></p>
                <p id="sardines-balance">J'ai <span>
                    <?php echo $_SESSION['user']->getBalance(); ?>
                </span> sardines</p>
            <?php endif; ?>
        </div>

        <?php include_once 'inc/_menu.php'; ?>

    </header>

    <div id="container">

        <div id="open"> <!-- le burger pour ouvrir le menu -->
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <h1><?= $title ?></h1>

        <?= $content ?>

        <footer>
            <!-- Footer -->
        </footer>

    </div>
    
    <script src="js/menu_toggle.js"></script>
</body>
</html>