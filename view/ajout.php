<?php

# CONTRÔLE DE L'ACCÈS
if (!isset($_SESSION['user'])) {
    header('Location: index');
} elseif ($_SESSION['user']->getStaff() == false) {
    header('Location: index');
}

$title = 'Ajouter un matériel';

?>

<?php ob_start(); ?>
<main>
    <!--    <div id="basket-bar"></div>-->

    <!-- Main -->
    <div class="view">
        <div class="header">
            <div class="logo">
                <div id="open"> <!-- le burger pour ouvrir le menu -->
                </div>
                <img src="images/pictos/logo_text_3.svg" alt="Les Sardines">
                <div></div>
            </div>
            <div class="blue uper bold" id="first-new-asset">
                nouvelle saisie
            </div>
        </div>

        <form action="insertAsset" method="post">


            <p id="step1" class="flex-center step">Etape 1 : Saisir l'ID du festivalier ou le code générique</p>

            <div class="flex-center">
                <input type="text" class="input" name="iduser" id="iduser" placeholder="identifiant">
            </div>

            <div id="responseUser">
                <img id="logoResponse" class="logoResponse" src="images/pictos/valid.svg">
                <p class="flex-center" id="error-id">test</p>
            </div>

    </div>
    <div class="view">
        <p id="step2" class="flex-center step">Etape 2 : Choisir le type de matériel</p>
        <!-- LES RADIOS TYPE -->
        <?php
        $i = 1
        ?>
        <?php foreach ($types as $type):
            if ($i % 2 == 1) {
                echo '<div class="flex-center">';
            }
            # formatage du name pour en faire un identifiant en camelCase
            $cssID = explode(' ', $type['name']);
            $cssID = array_map(function ($x) {
                return ucfirst($x);
            }, $cssID);
            $cssID = lcfirst(implode('', $cssID));
            ?>
            <div class="item-button">
                <input type="radio"
                       id="<?php echo $cssID ?>"
                       name="idtype"
                       value="<?php echo $type['id_type'] ?>">
                <button class="btn-white" name="<?php echo $cssID ?>"></button>
                <p class="label-type"><?= $type['name']; ?></p>
            </div>

            <?php
            if ($i % 2 == 0) {
                echo '</div>';
            }
            $i++;
            ?>
        <?php endforeach; ?>
    </div>

    <div class="view">
        <p class="flex-center step">Etape 3 : Précisez l'état du matériel</p>
        <br> <!-- LES RADIOS QUALITE -->
        <div class="flex-center">
            <?php foreach ($qualities as $quality):
                # en l'état actuel, pas de formatage du label nécessaire pour les qualités
                ?>
                <div class="item-button2">
                    <input type="radio"
                           id="<?php echo $quality['label'] ?>"
                           name="idquality"
                           value="<?php echo $quality['id_quality'] ?>">
                    <button class="btn-white2" name="<?php echo $quality['label'] ?>"></button>
                    <p><?php echo $quality['label'] ?></p>
                </div>


            <?php endforeach; ?>
        </div>
        <br/> <!-- détails sur l'état du matos -->
        <div class="flex-center">
            <textarea class="flex-center" name="description" id="details" cols="30" rows="10"
                      placeholder="Commentaire..."></textarea>

        </div>

        <br/> <!-- Récuperer la valeur de la récompense -->
        <div class="flex-center">
            <p>Recompense de <b><span id="recompense"> ? </span></b> sardines</p>
        </div>

        <br/>
        <div class="flex-center">
            <input class="btn-full-login" name="add-asset" type="submit" id="submit" value="valider">
        </div>

    </div>
    </form>
</main>

<script src="js/insert_asset_process.js"></script>


<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>
