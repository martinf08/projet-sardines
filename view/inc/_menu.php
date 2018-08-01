<?php 
    $prefix = $prefix ?? ''; # corrige les liens pour la page profil (prefix = '../' si on se trouve dans profil ou forget)
?>

<nav style="background:#ccc;">
    <ul>
        <li><a href="<?= PUBLIC_URL ?>index">Accueil</a></li>

        <?php if (!isset($_SESSION['islog'])): ?>
            <li><a href="<?= PUBLIC_URL ?>inscription">S'inscrire</a></li>
        <?php elseif ($_SESSION['islog'] == false): ?>
            <li><a href="<?= PUBLIC_URL ?>connexion">Se connecter</a></li>
        <?php endif; ?>

        <?php 
            if (!empty($_SESSION['user'])):
            if ($_SESSION['user']->getStaff()):
        ?>
            <li><a href="<?= PUBLIC_URL ?>ajout">Ajouter du matériel</a></li>
        <?php
            endif; 
            endif; 
        ?>

        <?php if (isset($_SESSION['islog']) AND $_SESSION['islog'] == true): ?>
            <li><a href="<?= PUBLIC_URL ?>profil/<?= $_SESSION['user']->getIdentifier(); ?>">Voir mes informations</a></li>
            <li><a href="<?= PUBLIC_URL ?>exit">Me déconnecter</a></li>
        <?php endif; ?>

        <li><a href="<?= PUBLIC_URL ?>#">F.A.Q. (c'est quoi ?)</a></li>
        <li><a href="<?= PUBLIC_URL ?>#">Mentions légales</a></li>
    </ul>
</nav>