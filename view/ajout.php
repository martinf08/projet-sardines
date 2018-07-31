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
    <div id="basket-bar"></div>
    <?php if (isset($result)) {
        print_r($result);
    } ?>
    <!-- Main -->
    <form action="insertAsset" method="post">
        <div class="view">
            <h1 class="flex-center">nouvelle saisie</h1>

            <h2 class="flex-center">Etape 1 : Saisir l'ID du festivalier ou le code générique</h2>

            <br/> <!-- Optionnel -->
            <div class="flex-center">
                <input type="text" name="iduser" id="iduser" placeholder="identifiant">
            </div>

            <br/> <!-- Optionnel -->

            <div class="flex-center" id="error-id"></div>
        </div>
        <div class="view">
            <h4 class="flex-center">Etape 2 : Choisir le type de matériel</h4>
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
                <input type="radio"
                       id="<?php echo $cssID ?>"
                       name="idtype"
                       value="<?php echo $type['id_type'] ?>">
                <button class="btn-white" name="<?php echo $cssID ?>"></button>
                <?php
                if ($i % 2 == 0) {
                    echo '</div>';
                }
                $i++;
                ?>
            <?php endforeach; ?>
        </div>

        <div class="view">
            <h4 class="flex-center">Etape 3 : Précisez l'état du matériel</h4>
            <br> <!-- LES RADIOS QUALITE -->
            <div class="flex-center">
                <?php foreach ($qualities as $quality):
                    # en l'état actuel, pas de formatage du label nécessaire pour les qualités
                    ?>

                    <input type="radio"
                           id="<?php echo $quality['label'] ?>"
                           name="idquality"
                           value="<?php echo $quality['id_quality'] ?>">
                    <button class="btn-white" name="<?php echo $quality['label'] ?>"></button>

                <?php endforeach; ?>
            </div>
            <br/> <!-- détails sur l'état du matos -->
            <div class="flex-center">
            <textarea class="flex-center" name="description" id="details" cols="30" rows="10"
                      placeholder="Infos supplémentaires (Optionnel)"></textarea>

            </div>

            <br/> <!-- Récuperer la valeur de la récompense -->
            <div class="flex-center">
                <p>Recompense de <b><span id="recompense"> ? </span></b> sardines</p>
            </div>

            <br/>
            <div class="flex-center">
                <input class="btn-full-login" type="submit" id="submit" value="valider">
            </div>

        </div>
    </form>
</main>

<script src="js/insert_asset_process.js"></script>


<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>
