<nav style="background:#ccc;">
    <?php 
    # debug, à nettoyer
    #if(isset($_SESSION['user'])) print_r($_SESSION['user']); ?>
    <ul>
        <li><a href="index">Accueil</a></li>

        <?php if (!isset($_SESSION['isLogged'])): ?>
            <li><a href="inscription">S'inscrire</a></li>
        <?php endif; ?>

        <?php 
            if (!empty($_SESSION['user'])):
            if ($_SESSION['user']->getStaff() OR $_SESSION['user']->getAdmin()):
        ?>
            <li><a href="ajout">Ajouter du matériel</a></li>
        <?php
            endif; 
            endif; 
        ?>

        <?php if (isset($_SESSION['isLogged']) AND $_SESSION['isLogged'] == true): ?>
            <li><a href="profil/<?= $_SESSION['user']->getIdentifier(); ?>">Voir mes informations</a></li>
            <li><a href="logOut">Me déconnecter</a></li>
        <?php endif; ?>

        <li><a href="#">F.A.Q. (c'est quoi ?)</a></li>
        <li><a href="#">Mentions légales</a></li>
    </ul>

</nav>