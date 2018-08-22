<main>


    <!-- je mets les champs brut sans me soucier du layout, il suffira de les copier/coller où il faut -->
    <!-- je suppose que les valeurs seront récupérées dans l'objet user et pas dans la session -->

    <!--<div id="avatar-field">-->
    <?php #if(!empty($user->getAvatar())): ?>
    <!--<div id="avatar" style="background-image: url('../css/img/<?php #echo $user->getAvatar(); ?>');"></div>-->
    <?php #else: ?>
    <!--mettre un avatar par défaut ici dans le html (cas d'un user n'ayant pas encore enregistré d'avatar)-->
    <?php #endif; ?>
    <!--<input type="file" name="" id="">
</div>-->
    <form action="<?= Config::$root ?>accountUpdate" method="post" enctype="multipart/form-data">
        <div class="logo">
            <div class="header-left">
                <img id="open" src="images/pictos/burger_open.svg" alt="">
                <a href="<?= Config::$root ?>donner"><img id="arrow-back" src="images/pictos/arrow_back.svg" alt=""></a>
            </div>
            <h1><?= $title ?></h1>
            <div class="header-right"></div>
        </div>
        <div class="avatar-box">
            <?php
            if (isset($avatar) && !empty($avatar)) {
                echo '<img class="avatar-img" src="images/avatar/' . $avatar . '" alt="">';
            }
            else {
                    echo '<div id="avatar-box">';
                    echo '<img id="avatar-img" src="./images/avatar/avatar_default.png" alt="avatar">';
                    echo '</div>';
            }
            ?>
<!--            <input type="file" name="avatar" id="avatar">-->
        </div>
        <div class="center-box">
            <div class="left-box">
                <p>BONJOUR</p>
                <div class="input-profil">
                    <img src="images/pictos/edit.svg" alt="">
                    <input type="text" name="pseudo_account" id="pseudo-account" placeholder="modifier le pseudo" value="<?= $user->getNickname(); ?>"/>
                </div>

            </div>
            <div class="right-box">
                <p>ID : <?= $user->getIdentifier(); ?></p>
                <p>Solde Sardines : </p>
                <p> <?= $user->getBalance(); ?> </p>
            </div>
        </div>

        <div class="under-box">
            <p>Email : <?= $user->getEmail(); ?></p>
            <p>Date de création du compte : <?= $user->getAccount_creation_date(); ?>
            <p>Dernière connexion : <?= $user->getLast_Login(); ?></p>
            <?php
            if ($user->getStaff() OR $user->getAdmin()):
                ?>
                <?php if ($user->getStaff()): ?>
                <p>Vous êtes membre interne des Sardines.</p>
            <?php endif; ?>
                <?php if ($user->getAdmin()): ?>
                <p>Vous êtes administrateur.</p>
            <?php endif; ?>
            <?php endif; ?>

        </div>
        <div class="button-sub">
            <input type="submit" name="submit-account" class="btn-full-donation" value="Valider">
        </div>

    </form>
    <script src="js/profil.js"></script>
</main>
