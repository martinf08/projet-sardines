<?php $title = 'Mon compte'; ?>

<?php ob_start(); ?>
<main>

<?= $title ?>

<!-- je mets les champs brut sans me soucier du layout, il suffira de les copier/coller où il faut -->
<!-- je suppose que les valeurs seront récupérées dans l'objet user et pas dans la session -->
<!-- PAGE PAS ENCORE TESTÉES AVEC DES DONNÉES ! c'est un modèle -->

<div id="avatar-field">
    <div id="avatar" style="background-image: url('../css/img/<?= $user->getAvatar(); ?>');"></div><!-- chemin de stockage images par encore défini -->
    <input type="file" name="" id=""><!-- input pour changer d'image -->
</div>

<p>Mon identifiant unique : <span id="identifier">
    <?= $user->getIdentifier(); ?>
</span></p>

<p>Mon solde : <span id="balance"> 
    <?= $user->getBalance(); ?> 
</span></p>

<form action="accountUpdate" method="post">
    <!-- chaque champ est disable pas défaut pour ne montrer que la valeur actuelle -->
    <!-- pour les modifier il faudra cliquer sur le petit crayon qui ciblera son input voisin pour l'enable -->
    <p>Email : <input type="email" name="" id="" value="<?= $user->getEmail(); ?>"> 
                <span class="write">ici fonticone d'un crayon</span>
    </p>
    <p>Pseudo : <input type="text" name="" id="" value="<?= $user->getNickName(); ?>"> 
                <span class="write">ici fonticone d'un crayon</span>
    </p>
    <input type="submit" value="Enregistrer">
</form>

<div id="log">
    <p>Date de création du compte : <span><?= $user->getAccount_creation_date(); ?></span></p>
    <p>Dernière connexion : <span><?= $user->getLast_Login(); ?></span></p>
</div>

<?php 
    if ($user->getStaff() OR $user->getAdmin()):
?>
<div id="access">
    <?php if ($user->getStaff()): ?>
        <p>Vous êtes membre interne des Sardines.</p>
    <?php endif; ?>
    <?php if ($user->getAdmin()): ?>
        <p>Vous êtes administrateur.</p>
    <?php endif; ?>
</div>
<?php endif; ?>

</main>
<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>