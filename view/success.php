<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 20/07/18
 * Time: 16:34
 */

$title = 'Succès de la transaction';
?>

<?php ob_start(); ?>
<main>

Félicitation, <?= $_SESSION['lastAsset']->getUserEmail(); ?>,
vous venez de donner un objet de type <?= $_SESSION['lastAsset']->getNameIdType(); ?>,
de qualité <?= $_SESSION['lastAsset']->getNameIdQuality(); ?>.
Vous remportez ainsi <?= $_SESSION['lastAsset']->getValue(); ?> Sardines.<br/>
    Le  tag  est : <b><?= $_SESSION['lastAsset']->getTag(); ?></b>
</main>
<?php $content = ob_get_clean(); ?>
<?php require_once 'view/template.php'; ?>