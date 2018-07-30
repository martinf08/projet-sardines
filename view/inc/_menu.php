<?php 
    $prefix = $prefix ?? ''; # corrige les liens pour la page profil (prefix = '../' si on se trouve dans profil)
?>

<nav style="background:#ccc;">
    <ul>
        <li><a href="<?= $prefix ?>index">Accueil</a></li>

        <?php if (!isset($_SESSION['islog'])): ?>
            <li><a href="<?= $prefix ?>inscription">S'inscrire</a></li>
        <?php elseif ($_SESSION['islog'] == false): ?>
            <li><a href="<?= $prefix ?>connexion">Se connecter</a></li>
        <?php endif; ?>

        <?php 
            if (!empty($_SESSION['user'])):
            if ($_SESSION['user']->getStaff() OR $_SESSION['user']->getAdmin()):
        ?>
            <li><a href="<?= $prefix ?>ajout">Ajouter du matériel</a></li>
        <?php
            endif; 
            endif; 
        ?>

        <?php if (isset($_SESSION['islog']) AND $_SESSION['islog'] == true): ?>
            <li><a href="<?= $prefix ?>profil/<?= $_SESSION['user']->getIdentifier(); ?>">Voir mes informations</a></li>
            <li><a href="<?= $prefix ?>exit">Me déconnecter</a></li>
        <?php endif; ?>

        <li><a href="<?= $prefix ?>#">F.A.Q. (c'est quoi ?)</a></li>
        <li><a href="<?= $prefix ?>#">Mentions légales</a></li>
    </ul>
</nav>