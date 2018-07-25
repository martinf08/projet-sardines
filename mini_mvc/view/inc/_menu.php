<?php
session_start();
?>

<nav>
    <ul>
        <li><a href="index">Accueil</a></li>
        <li><a href="profil/<?php echo $_SESSION['user']['identifier'] ?>">Modifier mes informations</a></li>
        <li><a href="#">F.A.Q.</a></li>
        <?php if ($_SESSION['user']['staff'] || $_SESSION['user']['staff']): ?>
        <li><a href="ajout">Ajouter du matériel</a></li>
        <?php endif; ?>
        <li><a href="#">Mentions légales</a></li>
    </ul>

    <a href="logOut">Déconnexion</a>
</nav>