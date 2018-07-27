
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/connexion.css">

</head>
<body>
    <?php 
    # à nettoyer quand plus besoin
    #debug($_SESSION); 
    ?>

    <header>
        <!-- Header -->
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
        <h1><?= $title ?></h1>

    </header>


    <?= $content ?>

    <footer>
        <!-- Footer -->
    </footer>
</body>

<script src="js/verif_form.js"></script>
</html>