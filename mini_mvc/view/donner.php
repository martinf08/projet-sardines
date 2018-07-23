<?php $title = 'Déposer mon matos'; ?>

<?php ob_start(); ?>
<main>

ici le contenu de <?= $title ?>

</main>
<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>