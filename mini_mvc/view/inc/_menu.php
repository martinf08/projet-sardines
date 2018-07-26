<?php
session_start();
?>

<nav>
    <ul>
        <li><a href="index">Accueil</a></li>

        <?php if (isset($_SESSION['isLogged']) AND $_SESSION['isLogged'] == true): ?>
        <li><a href="profil/<?php echo $_SESSION['user']['identifier'] ?>">Modifier mes informations</a></li>
        <?php endif; ?>

        <li><a href="#">F.A.Q.</a></li>

        <?php if ($_SESSION['user']['staff'] OR $_SESSION['user']['admin']): ?>
        <li><a href="ajout">Ajouter du matériel</a></li>
        <?php endif; ?>

        <li><a href="#">Mentions légales</a></li>
    </ul>

    <a href="logOut">Déconnexion</a>
</nav>