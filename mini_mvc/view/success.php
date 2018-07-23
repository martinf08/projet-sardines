<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 20/07/18
 * Time: 16:34
 */

session_start();

?>
Félicitation, <?= $_SESSION['lastAsset']->getUserEmail(); ?>,
vous venez de donner un objet de type <?= $_SESSION['lastAsset']->getNameIdType(); ?>,
de qualité <?= $_SESSION['lastAsset']->getNameIdQuality(); ?>.
Vous remportez ainsi <?= $_SESSION['lastAsset']->getValue(); ?> Sardines.
