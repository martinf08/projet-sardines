<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/cheatsheet.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/insert-test.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/header.css"><!-- contient simplement les classes pour position et effet tiroir -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/insert-asset.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/slider.css">

    <?php if (isset($css)): # passer du css depuis le controller (changer ça en boucle s'il faut) ?>
        <?php foreach ($css as $value){?>
        <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/<?= $value ?>.css">
    <?php } endif; ?>

</head>
<body>

     <?php 
        echo getMenu();
    ?>

    <div id="container">
    <?php 
        echo getBermenu();
    ?>
        <h1><?= $title ?></h1>
      
        <?= $content ?>

    </div>
    
    <script src="<?= PUBLIC_URL ?>js/menu_toggle.js"></script>
     <script src="<?=PUBLIC_URL?>js/signin_login_validation.js"></script>
</body>
</html>