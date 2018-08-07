<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= Config::$root ?>css/cheatsheet.css">
    <link rel="stylesheet" href="<?= Config::$root ?>css/standard.css"><!-- contient simplement les classes pour position et effet tiroir -->

    <?php if (isset($css)): # passer du css depuis le controller (changer ça en boucle s'il faut) ?>
        <?php foreach ($css as $value){?>
        <link rel="stylesheet" href="<?= Config::$root ?>css/<?= $value ?>.css">
    <?php } endif; ?>

</head>
<body>

    <div id="menu">
        
        <div id="close"><!-- fermeture du menu -->
            <div class="cross"></div>
        </div>

        <div id="display-user"><!-- ici l'affiche des infos de l'user connecté -->
            <?php if(isset($_SESSION['user']) AND !empty($_SESSION['user'])): ?>
                <p id="pseudo" class="bold"><?php echo $_SESSION['user']->getNickname(); ?></p>
                <p id="mail"><?php echo $_SESSION['user']->getEmail(); ?></p>
                <p id="user-id" class="bold">ID : <?php echo strtoupper($_SESSION['user']->getIdentifier()); ?></p>
                <p id="sardines-balance">J'ai <span class="bold">
                    <?php echo $_SESSION['user']->getBalance(); ?>
                </span> sardines</p>
            <?php endif; ?>
        </div>

        <?php include_once 'inc/_menu.php'; ?>

        <div id="triangle-bottomleft"></div>
        <div id="triangle-bottomright"></div>

    </div>

    <div id="container">

        <?php if (isset($_SESSION['user']) AND !empty($_SESSION['user'])): ?>
        <?php if (!$_SESSION['user']->getAccount_status()): ?>
            <div id="warning">ce compte n'est pas encore activé</div>
            <?php endif; ?> 
        <?php endif; ?>
      
        <div id="open"> <!-- le burger pour ouvrir le menu -->
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <!--<h1><?= $title ?></h1>-->
      
        <?= $content ?>

    </div>
    
    <script src="<?= Config::$root ?>js/menu_toggle.js"></script>

</body>
</html>