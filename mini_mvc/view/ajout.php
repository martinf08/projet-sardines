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

        <input type="text" name="identifiant" id="identifiant" placeholder="identifiant">

        <br /> <!-- Optionnel -->

        <div id="error-id">ID invalide</div>

        <br /> 

        <input type="radio" id="tent" name="type" value="tent">
        <label for="tent">Tente</label>
        <input type="radio" id="sleepingBag" name="type" value="sleeping bag">
        <label for="sleepingBag">Sac de couchage</label>

        <br /> 

        <input type="radio" id="chair" name="type" value="chair">
        <label for="chair">Chaise</label>
        <input type="radio" id="mattress" name="type" value="mattress">
        <label for="mattress">Matelas</label>

        <br /> 

        <input type="radio" id="bad" name="quality" value="1">
        <label for="bad">Mauvais</label>
        <input type="radio" id="good" name="quality" value="2">
        <label for="good">Bon</label>
        <input type="radio" id="excellent" name="quality" value="3">
        <label for="excellent">Excellent</label>

        <br /> <!-- détails sur l'état du matos -->

        <textarea name="description" id="details" cols="30" rows="10">Infos supplémentaires (Optionnel)</textarea>

        <br /> <!-- Recuperer la valeur de la recompense -->

        <p>Recompense de <span id="recompense">10 (icon sardine)</span></p>

        <br /> 

        <input type="text" name="staff" value="3" style="display: none;">


        <input type="submit" id="submit" value="valider">


    </form>
</main>
<footer>
    <!-- Footer -->
</footer>
</body>
</html>