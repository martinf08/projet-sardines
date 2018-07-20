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

        <input type="text" name="iduser" id="iduser" placeholder="identifiant">

        <br /> <!-- Optionnel -->

        <div id="error-id">ID invalide</div>

        <br /> 

        <input type="radio" id="tent" name="idtype" value="1">
        <label for="tent">Tente</label>
        <input type="radio" id="sleepingBag" name="idtype" value="2">
        <label for="sleepingBag">Sac de couchage</label>

        <br /> 

        <input type="radio" id="chair" name="idtype" value="3">
        <label for="chair">Chaise</label>
        <input type="radio" id="mattress" name="idtype" value="4">
        <label for="mattress">Matelas</label>

        <br /> 

        <input type="radio" id="bad" name="idquality" value="1">
        <label for="bad">Mauvais</label>
        <input type="radio" id="good" name="idquality" value="2">
        <label for="good">Bon</label>
        <input type="radio" id="excellent" name="idquality" value="3">
        <label for="excellent">Excellent</label>

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

<script src="/projet-sardines/mini_mvc/js/getvalue.js"></script>
<script src="/projet-sardines/mini_mvc/js/getuserid.js"></script>

</body>
</html>