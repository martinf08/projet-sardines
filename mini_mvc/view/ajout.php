<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Organisateur</title>
</head>
<body>
<header>
    <!-- Header -->
    <div id="menu-berger">Menu</div>
    <h1>Titre Page</h1>
</header>
<main>
<?php if(isset($result)) { print_r($result); } ?>
    <!-- Main -->
    <form action="insertAsset" method="post">
        <input type="radio" id="avecBeneficiaire" name="beneficiaire" value="avecBeneficiaire">
        <label for="avecBeneficiaire">avec bénéficiaire</label>
        <input type="radio" id="sansBeneficiaire" name="beneficiaire" value="sansBeneficiaire">
        <label for="sansBeneficiaire">sans bénéficiaire</label>

        <br /> <!-- Optionnel -->

        <input type="text" name="iduser" id="idUser" placeholder="identifiant">

        <br /> <!-- Optionnel -->

        <div id="error-id">ID invalide</div>

        <br /> 

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
                value="<? echo $type['id_type'] ?>">

        <label for="<?php echo $cssID ?>">
            <?php echo ucfirst($type['name']) ?>
        </label>

        <?php endforeach; ?>

        <br> <!-- LES RADIOS QUALITE -->

        <?php foreach($qualities as $quality):
        # pen l'état actuel, pas de formatage du label nécessaire pour les qualités
        ?>

        <input type="radio" 
                id="<?php echo $quality['label'] ?>" 
                name="idquality" 
                value="<? echo $quality['id_quality'] ?>">

        <label for="<?php echo $quality['label'] ?>">
            <?php echo ucfirst($quality['label']) ?>
        </label>

        <?php endforeach; ?>

        <br /> <!-- détails sur l'état du matos -->

        <textarea name="description" id="details" cols="30" rows="10">Infos supplémentaires (Optionnel)</textarea>

        <br /> <!-- Recuperer la valeur de la recompense -->

        <p>Recompense de <span id="recompense">0</span> sardines</p>

        <br /> 

        <input type="text" name="idstaff" value="FT43" style="display: none;">
        <input type="text" id="sardines" name="value" style="display: none;">


        <input type="submit" id="submit" value="valider">


    </form>
</main>
<footer>
    <!-- Footer -->
</footer>

<script src="./js/getValue.js"></script>

</body>
</html>