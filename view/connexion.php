<!-- Main -->
<main>

    <div class="connexion-content">
        <div class="flex-center">
    <!--<img src="./images/ressources/user.png" alt="user" class="img-connexion">-->
    </div>


    <br/> <!-- Optionnel -->

    <form method="POST" action="log" enctype="multipart/form-data"> 
        <div class="flex-center form-input">
            <input class ="input" type="email" id="email" name="email" placeholder="johndoe@mail.com">
        </div>
        <div class="flex-center form-input">
            <input type="password" class="input" id="password" name="password" placeholder=".......">
            <div class="tooltip">entre au minimum 6 caractères</div>
        </div>

        <div id="mdp-oublie" class="flex-center"><a href="forget">mot de passe oublié ?</a></div>
        <div class="flex-center">
            <input class="btn-full-signup" type="submit" value="Se connecter">
        </div>
   </form>
    <div><p>Pas de compte ? <a href="inscription">Je m'inscris.</a></p></div>
    <!--<div id="inscrire-social" class="flex-center">
        <p>S'inscrire avec :</p>
    </div>
    <div class="socials-icon">
        <div class="cirle-social"><i class="fab fa-facebook-f"></i></div>
        <div class="cirle-social"><i class="fab fa-twitter"></i></div>
        <div class="cirle-social"><i class="fab fa-google-plus-g"></i></div>
    </div>-->
    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>
    <script src="<?=PUBLIC_URL?>js/signin_login_validation.js"></script>
</main>
