<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 20/07/18
 * Time: 16:34
 */

if (!isset($userInfos)) $userInfos['nickname'] = 'cet utilisateur non trouvé ¯\_(ツ)_/¯';

?>

<main>
    <div id="header" class="slideFromTop">
        <div id="open">
            <svg width="100%" height="100%" viewBox="0 0 13 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><rect x="-0.001" y="0.002" width="12.769" height="1.513" style="fill:#009688;"/><rect x="0" y="3.738" width="12.77" height="1.513" style="fill:#009688;"/><rect x="0.006" y="7.416" width="8.988" height="1.513" style="fill:#009688;"/></svg>
        </div>

        <h1><?= $title ?></h1>

    </div><!-- /header -->

    <div id="arrow">
        <a href="ajout"><svg width="100%" height="100%" viewBox="0 0 28 11" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><rect x="0.877" y="4.291" width="27" height="1.471" style="fill:#009688;"/><path d="M4.937,0l-4.911,4.853l1.068,1.08l4.91,-4.853l-1.067,-1.08Z" style="fill:#009688;"/><path d="M1.16,3.924l4.817,5.701l-1.16,0.98l-4.817,-5.701l1.16,-0.98Z" style="fill:#009688;"/></svg></a>
    </div>

    <!-- ancienne version
    <p class="success">Félicitation, <span class="bold"><?= $_SESSION['lastAsset']->getUserEmail(); ?></span>,
    vous venez de donner un objet de type <span class="bold"><?= $_SESSION['lastAsset']->getNameIdType(); ?></span>,
    de qualité <span class="bold"><?= $_SESSION['lastAsset']->getNameIdQuality(); ?></span>.</p>
    <p class="success">Vous remportez ainsi <span class="bold"><?= $_SESSION['lastAsset']->getValue(); ?></span> Sardines.</p>
    <p class="success">Le  tag  est : <span class="bold"><?= $_SESSION['lastAsset']->getTag(); ?></span></p>
    -->

    <!-- nouvelle version -->
    <p class="success">L'objet <?= $_SESSION['lastAsset']->getNameIdType(); ?> a bien été ajouté, tu peux féliciter <span class="bold"><?= $userInfos['nickname'] ?? strtoupper($userInfos['identifier']); /*au cas où l'user n'a aucun nickname*/ ?></span> (<?= $_SESSION['lastAsset']->getUserEmail(); ?>) pour ce don qui sera valorisé !</p>
    <p class="success">Ce don lui rapporte <span class="bold"><?= $_SESSION['lastAsset']->getValue(); ?> Sardines</span> qui pourront être réutilisées ultérieurement (si cette expérimentation continue).</p>
    <p class="success">Tu peux maintenant étiqueter ce matériel en y apposant la référence <span class="bold"><?= $_SESSION['lastAsset']->getTag(); ?></span> et le stocker.</p>

    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>
</main>
