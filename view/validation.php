<main>

    <div class="logo">
        <div></div>
        <img src="images/pictos/logo_text_1.svg" alt="Les Sardines">
        <div></div>
    </div>
    <div class="message-validation">
        <p>
            Vous êtes maintenant inscrit sur notre site,
            un courriel d'activation a été envoyé à <br/>
            l'adresse suivante : <b><?= $_SESSION['user']->getEmail();?></b>
        </p>
        <div class="btn-full-2">
            <a href="<?= Config::$root ?>donner" class="btn-full-txt">Continuer</a>
        </div>
    </div>


    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>

</main>