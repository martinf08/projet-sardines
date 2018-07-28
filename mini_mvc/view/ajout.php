<?php

# CONTRÔLE DE L'ACCÈS
if (!isset($_SESSION['user'])) {
    header('Location: index');
} elseif ($_SESSION['user']->getStaff() == false AND $_SESSION['user']->getAdmin() == false) {
    header('Location: index');
}

$title = 'Ajouter un matériel';

?>

<?php ob_start(); ?>

<main>
    <div id="basket-bar"></div>
<?php if(isset($result)) { print_r($result); } ?>
    <!-- Main -->
    <form action="insertAsset" method="post">
        <div class="view">
            <h1>nouvelle saisie</h1>
            <p>Etape 1 : Saisir l'ID du festivalier ou le code générique</p>

            <br /> <!-- Optionnel -->

            <input type="text" name="iduser" id="iduser" placeholder="identifiant">

            <br /> <!-- Optionnel -->

            <div id="error-id"></div>
        </div>

        <div class="view">
            <p>Etape 2 : Choisir le type de matériel</p>
            <!-- LES RADIOS TYPE -->
            <?php foreach($types as $type):
                # formatage du name pour en faire un identifiant en camelCase
                $cssID = explode(' ', $type['name']);
                $cssID = array_map(function($x) {
                    return ucfirst($x);
                }, $cssID);
                $cssID = lcfirst(implode('', $cssID));

                ?>

                <input type="radio"
                       id="<?php echo $cssID ?>"
                       name="idtype"
                       value="<?php echo $type['id_type'] ?>">

                <label for="<?php echo $cssID ?>">
                    <?php echo ucfirst($type['name']) ?>
                </label>

            <?php endforeach; ?>
        </div>

<div class="view">
    <p>Etape 3 : Précisez l'état du matériel</p>
    <br> <!-- LES RADIOS QUALITE -->
    <?php foreach($qualities as $quality):
        # en l'état actuel, pas de formatage du label nécessaire pour les qualités
        ?>

        <input type="radio"
               id="<?php echo $quality['label'] ?>"
               name="idquality"
               value="<?php echo $quality['id_quality'] ?>">

        <label for="<?php echo $quality['label'] ?>">
            <?php echo ucfirst($quality['label']) ?>
        </label>

    <?php endforeach; ?>
    <br /> <!-- détails sur l'état du matos -->

    <textarea name="description" id="details" cols="30" rows="10" placeholder="Infos supplémentaires (Optionnel)"></textarea>

    <br /> <!-- Récuperer la valeur de la récompense -->

    <p>Recompense de <span id="recompense">?</span> sardines</p>

    <br />

    <input type="submit" id="submit" value="valider">
</div>







    </form>
</main>

<script src="/projet-sardines/mini_mvc/js/getvalue.js"></script>
<script src="/projet-sardines/mini_mvc/js/insert_asset_process.js"></script>


<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>
