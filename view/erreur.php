<?php $title = 'Il y a eu un problème'; ?>

<?php ob_start(); ?>
<main>

    <p><?= $errorMessage ?></p>

    <a href="index"><- (retour sur l'accueil)</a>

</main>
<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>