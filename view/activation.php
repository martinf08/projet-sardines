<main>

    <div class="logo">
        <div></div>
        <img src="../images/pictos/logo_text_1.svg" alt="Les Sardines">
        <div></div>
    </div>
    <div class="message-validation">
        <p class="center">
            <?= $response; ?>
        </p>
        <div class="btn-full-2">
            <?php
            if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                echo '<a href="'. Config::$root .'donner" class="btn-full-txt">Retour à l\'accueil</a>';
            }
            else {
                echo '<a href="'. Config::$root .'connexion" class="btn-full-txt">Connexion</a>';
            }
            ?>

        </div>
    </div>
</main>