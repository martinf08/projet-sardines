<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 20/07/18
 * Time: 16:34
 */
?>

<main>

    <div id="header" class="slideFromTop">
        <div id="open">
            <svg width="100%" height="100%" viewBox="0 0 13 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><rect x="-0.001" y="0.002" width="12.769" height="1.513" style="fill:#009688;"/><rect x="0" y="3.738" width="12.77" height="1.513" style="fill:#009688;"/><rect x="0.006" y="7.416" width="8.988" height="1.513" style="fill:#009688;"/></svg>
        </div>

        <h1><?= $title ?></h1>

        <!-- nombre sardines -->
        <?php if (isset($_SESSION['user']) AND !empty($_SESSION['user'])): ?>
            <div id="sardines" style="background: #0cd18f;box-shadow: 0 2px 4px 0 rgba(0,0,0, 0.3);"><span class="bold"><?= $_SESSION['user']->getBalance() ?></span> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 369.209 369.209" style="enable-background:new 0 0 369.209 369.209;" xml:space="preserve">
    <g>
        <g>
            <path d="M308.79,55.355c-1.86-1.815-4.348-2.842-6.947-2.866c-5.567,0.052-10.038,4.607-9.986,10.173
                c0.024,2.598,1.051,5.087,2.866,6.947c3.97,3.841,10.27,3.841,14.24,0C312.851,65.625,312.774,59.243,308.79,55.355z"/>
        </g>
    </g>
    <g>
        <g>
            <path d="M365.203,10.009L365.203,10.009c-0.673-3.036-3.044-5.407-6.08-6.08c-13.991-2.739-28.224-4.052-42.48-3.92
                c-56.4,0-188.64,21.28-212,216c-11.144-1.74-22.401-2.649-33.68-2.72c-37.84,0-62.16,11.68-70.4,33.68
                c-0.259,0.694-0.421,1.421-0.48,2.16c-0.165,9.202,3.382,18.083,9.84,24.64c12.16,13.28,33.52,20.64,64,21.84
                c2.88,69.92,38,73.6,45.2,73.6h1.28c0.739-0.059,1.466-0.221,2.16-0.48c40.72-15.2,34.72-80,31.04-104
                c82.88-9.92,143.12-40,179.04-90.16C384.643,101.209,366.083,13.689,365.203,10.009z M322.711,80.969
                c-9.48,10.844-25.956,11.949-36.8,2.468c-0.877-0.767-1.702-1.591-2.468-2.468h-0.08c-10.13-10.175-10.13-26.625,0-36.8
                c10.306-9.885,26.574-9.885,36.88,0C331.087,53.649,332.192,70.125,322.711,80.969z"/>
        </g>
    </g>
    </svg></div>
        <?php else: ?>
            <div id="sardines"></div>
        <?php endif; ?>
        <!-- /nombre sardines -->

    </div><!-- /header -->

    <p class="success">Félicitation, <span class="bold"><?= $_SESSION['lastAsset']->getUserEmail(); ?></span>,
    vous venez de donner un objet de type <span class="bold"><?= $_SESSION['lastAsset']->getNameIdType(); ?></span>,
    de qualité <span class="bold"><?= $_SESSION['lastAsset']->getNameIdQuality(); ?></span>.</p>
    <p class="success">Vous remportez ainsi <span class="bold"><?= $_SESSION['lastAsset']->getValue(); ?></span> Sardines.</p>
    <p class="success">Le  tag  est : <span class="bold"><?= $_SESSION['lastAsset']->getTag(); ?></span></p>

    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>
</main>
