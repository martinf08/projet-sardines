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
    <!-- Main -->
    <form action="targetstaff.php" method="post">
        <input type="radio" id="avecBeneficiaire" name="beneficiaire" value="avecBeneficiaire">
        <label for="avecBeneficiaire">avec bénéficiaire</label>
        <input type="radio" id="sansBeneficiaire" name="beneficiaire" value="sansBeneficiaire">
        <label for="sansBeneficiaire">sans bénéficiaire</label>

        <br /> <!-- Optionnel -->

        <input type="text" name="identifiant" id="identifiant" placeholder="identifiant">

        <br /> <!-- Optionnel -->

        <div id="error-id">ID invalide</div>

        <br /> <!-- Optionnel -->

        <input type="radio" id="tente" name="type" value="tente">
        <label for="tente">Tente</label>
        <input type="radio" id="sacCouchage" name="type" value="sacCouchage">
        <label for="sacCouchage">Sac de couchage</label>

        <br /> <!-- Optionnel -->

        <input type="radio" id="mobilier" name="type" value="mobilier">
        <label for="mobilier">Mobilier</label>
        <input type="radio" id="matelas" name="type" value="matelas">
        <label for="matelas">Matelas</label>

        <br /> <!-- Optionnel -->

        <input type="radio" id="etatRecycler" name="etat" value="etatRecycler">
        <label for="etatRecycler">Etat à recycler</label>
        <input type="radio" id="etatUser" name="etat" value="etatUser">
        <label for="etatUser">Etat user</label>
        <input type="radio" id="etatExelent" name="etat" value="etatExelent">
        <label for="etatExelent">Etat exelent</label>

        <br /> <!-- Optionnel -->

        <textarea name="details" id="details" cols="30" rows="10">Infos supplémentaires (Optionnel)</textarea>

        <br /> <!-- Optionnel -->

        <p>Recompense de <span id="recompense">10 (icon sardine)</span></p>

        <br /> <!-- Optionnel -->

        <input type="submit" id="submit" value="valider">


    </form>
</main>
<footer>
    <!-- Footer -->
</footer>
</body>
</html>