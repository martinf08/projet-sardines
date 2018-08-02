<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 20/07/18
 * Time: 16:34
 */
?>

<main>

    <div id="success">
        <p>Félicitation, <span class="bold"><?= $_SESSION['lastAsset']->getUserEmail(); ?></span>,
        vous venez de donner un objet de type <span class="bold"><?= $_SESSION['lastAsset']->getNameIdType(); ?></span>,
        de qualité <span class="bold"><?= $_SESSION['lastAsset']->getNameIdQuality(); ?></span>.</p>

        <p>Vous remportez ainsi <span class="bold"><?= $_SESSION['lastAsset']->getValue(); ?></span> Sardines.<br/>
        Le  tag  est : <span class="bold"><?= $_SESSION['lastAsset']->getTag(); ?></span></p>
    </div>

    <div class="links">
        <a href="<?= PUBLIC_URL ?>ajout"><- (ajouter un autre matériel)</a>
        <a href="<?= PUBLIC_URL ?>index"><- (retour sur l'accueil)</a>
    </div>
    
    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>

</main>
