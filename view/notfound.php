<?php $title = 'Tu t\'es perdu'; ?>

<?php ob_start(); ?>
<main>

Déso, cette page n'existe pas.

</main>
<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>