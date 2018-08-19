<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= Config::$root ?>css/cheatsheet.css">
    <link rel="stylesheet" href="<?= Config::$root ?>css/menu.css">
    <!-- contient simplement les classes pour position et effet tiroir -->
    <link rel="stylesheet" href="<?= Config::$root ?>css/anim.css">

    <?php if (isset($css)): # passer du css depuis le controller (changer ça en boucle s'il faut) ?>
        <?php foreach ($css as $value) { ?>
            <link rel="stylesheet" href="<?= Config::$root ?>css/<?= $value ?>.css">
        <?php } endif; ?>

</head>
<body>

<div id="menu">

    <div id="display-user"><!-- ici l'affiche des infos de l'user connecté -->

        <div id="close"><!-- fermeture du menu -->
            <svg width="100%" height="100%" viewBox="0 0 16 9" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                 style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><rect
                        x="2.252" y="0" width="12.748" height="1.513" style="fill:#0cd18f;"/>
                <rect x="0" y="3.738" width="12.77" height="1.513" style="fill:#0cd18f;"/>
                <rect x="6.006" y="7.416" width="8.988" height="1.513" style="fill:#0cd18f;"/></svg>
        </div>

        <?php if (isset($_SESSION['user']) AND !empty($_SESSION['user'])): ?>
            <?php
            $userManager = new UserManager();
            $avatar      = $userManager->findAvatar();
            if (isset($avatar) && !empty($avatar)) {
                echo '<div id="avatar-box">';
                echo '<img id="avatar-img" src="images/avatar/' . $avatar . '" alt="avatar">';
                echo '</div>';
            }
            ?>

            <p id="pseudo" class="bold"><?php echo $_SESSION['user']->getNickname(); ?></p>
            <p id="mail"><?php echo $_SESSION['user']->getEmail(); ?></p>
            <p id="user-id" class="bold">ID : <?php echo strtoupper($_SESSION['user']->getIdentifier()); ?></p>
            <p id="sardines-balance">J'ai <span class="bold">
                    <?php echo $_SESSION['user']->getBalance(); ?>
                </span> <span id="sardines-pic"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 369.209 369.209"
                                                     style="enable-background:new 0 0 369.209 369.209;"
                                                     xml:space="preserve">
<g>
	<g>
		<path d="M308.79,55.355c-1.86-1.815-4.348-2.842-6.947-2.866c-5.567,0.052-10.038,4.607-9.986,10.173
			c0.024,2.598,1.051,5.087,2.866,6.947c3.97,3.841,10.27,3.841,14.24,0C312.851,65.625,312.774,59.243,308.79,55.355z"/>
	</g>
</g>
<g>
	<g>
		<path d="M365.203,10.009L365.203,10.009c-0.673-3.036-3.044-5.407-6.08-6.08c-13.991-2.739-28.224-4.052-42.48-3.92
			c-56.4,0-188.64,21.28-212,216c-11.144-1.74-22.401-2.649-33.68-2.72c-37.84,0-62.16,11.68-70.4,33.68
			c-0.259,0.694-0.421,1.421-0.48,2.16c-0.165,9.202,3.382,18.083,9.84,24.64c12.16,13.28,33.52,20.64,64,21.84
			c2.88,69.92,38,73.6,45.2,73.6h1.28c0.739-0.059,1.466-0.221,2.16-0.48c40.72-15.2,34.72-80,31.04-104
			c82.88-9.92,143.12-40,179.04-90.16C384.643,101.209,366.083,13.689,365.203,10.009z M322.711,80.969
			c-9.48,10.844-25.956,11.949-36.8,2.468c-0.877-0.767-1.702-1.591-2.468-2.468h-0.08c-10.13-10.175-10.13-26.625,0-36.8
			c10.306-9.885,26.574-9.885,36.88,0C331.087,53.649,332.192,70.125,322.711,80.969z"/>
	</g>
</g>
</svg></span></p>
        <?php endif; ?>
    </div>

    <?php include_once 'inc/_menu.php'; ?>

    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>

</div>

<div id="container">
    <?php
    ?>
    <?php if (isset($_SESSION['user']) AND !empty($_SESSION['user'])): ?>
        <?php if (!$_SESSION['user']->getAccount_status()): ?>
            <div id="warning">ce compte n'est pas encore activé</div>
        <?php endif; ?>
    <?php endif; ?>

    <?= $content ?>

</div>

<script src="<?= Config::$root ?>js/menu_toggle.js"></script>

</body>
</html>