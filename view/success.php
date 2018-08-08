<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 20/07/18
 * Time: 16:34
 */
?>

<main>

    <p class="success">Félicitation, <span class="bold"><?= $_SESSION['lastAsset']->getUserEmail(); ?></span>,
    vous venez de donner un objet de type <span class="bold"><?= $_SESSION['lastAsset']->getNameIdType(); ?></span>,
    de qualité <span class="bold"><?= $_SESSION['lastAsset']->getNameIdQuality(); ?></span>.</p>
    <p class="success">Vous remportez ainsi <span class="bold"><?= $_SESSION['lastAsset']->getValue(); ?></span> Sardines.</p>
    <p class="success">Le  tag  est : <span class="bold"><?= $_SESSION['lastAsset']->getTag(); ?></span></p>

    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>
</main>
