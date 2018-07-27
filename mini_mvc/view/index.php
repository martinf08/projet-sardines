<h1>
    <?php 
        /*if(!empty($_SESSION['user'])){echo'Bonjour '.$_SESSION['user']->getEmail();
            echo'<h3>Bienvenue dans votre nouvel espace Sardines</h3>';
        }else{ echo"<h3>Page d'accueil</h3>";}*/
        # vue incomplète si on applique seulement ce code donc je réécris la page comme elle était avant
    ?>
</h1>

<?php $title = 'Les Sardines'; ?>

<?php ob_start(); ?>
<main>

ici le contenu de <?= $title ?>

</main>
<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>


