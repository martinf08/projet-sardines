<nav>
    <ul>
        <li><a href="<?= Config::$root ?>">Accueil</a></li>

        <?php if (!isset($_SESSION['islog'])): ?>
            <li><a href="<?= Config::$root ?>inscription">S'inscrire</a></li>
        <?php elseif ($_SESSION['islog'] == false): ?>
            <li><a href="<?= Config::$root ?>connexion">Se connecter</a></li>
        <?php endif; ?>

        <?php 
            if (!empty($_SESSION['user'])):
            if ($_SESSION['user']->getStaff()):
        ?>
            <li><a href="<?= Config::$root ?>ajout">Ajouter du matériel</a></li>
        <?php
            endif; 
            endif; 
        ?>

        <?php if (isset($_SESSION['islog']) AND $_SESSION['islog'] == true): ?>
            <li><a href="<?= Config::$root ?>profil/<?= $_SESSION['user']->getIdentifier(); ?>">Voir mes informations</a></li>
        <?php endif; ?>

        <li><a href="<?= Config::$root ?>#">F.A.Q.</a></li>
        <li><a href="<?= Config::$root ?>#">Mentions légales</a></li>

        <?php if (isset($_SESSION['islog']) AND $_SESSION['islog'] == true): ?>
            <li><a id="logout-link" href="<?= Config::$root ?>exit">Me déconnecter</a></li>
        <?php endif; ?>
    </ul>
</nav>