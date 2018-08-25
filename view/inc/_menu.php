<nav>
    <ul>
        <?php if (!isset($_SESSION['islog']) OR $_SESSION['islog'] === User::isNotlog ): ?>
            <li><a href="<?= Config::$root ?>">Accueil</a></li>
        <?php else: ?>
            <li><a href="<?= Config::$root ?>donner">Accueil</a></li>
        <?php endif; ?>
        
        <?php if (!isset($_SESSION['islog']) OR $_SESSION['islog'] === User::isNotlog ): ?>
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

        <?php if (isset($_SESSION['islog']) AND $_SESSION['islog'] === User::isLog ): ?>
            <li><a href="<?= Config::$root ?>profil">Voir mes informations</a></li>
        <?php endif; ?>

        <li><a href="<?= Config::$root ?>sardines">Le système Sardines</a></li>
        <li><a href="<?= Config::$root ?>mentions-legales">Mentions légales</a></li>

        <?php if (isset($_SESSION['islog']) AND $_SESSION['islog'] === User::isLog ): ?>
            <li><a id="logout-link" href="<?= Config::$root ?>exit">Me déconnecter</a></li>
        <?php endif; ?>
    </ul>
</nav>