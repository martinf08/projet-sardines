<!-- Main -->
<!-- AVATAR -->
<div class="flex-center">
    <!--<img src="./images/ressources/user.png" alt="user" class="img-connexion">-->
</div>


<br/> <!-- Optionnel -->

    <form method="POST" action="log" enctype="multipart/form-data"> 
        <div class="flex-center form-input">
            <input class ="input" type="email" id="email" name="email" placeholder="johndoe@mail.com">
        </div>


        <div class="flex-center form-input">
            <input type="password" class="input tooltip" id="password" name="password" placeholder=".......">
        </div>


        <div id="mdp-oublie" class="flex-center"><a href="forget">mot de passe oublié ?</a></div>
        <div class="flex-center">
            <input class="btn-full-signup" type="submit" value="Se connecter">
        </div>

</form>

<p>Pas de compte ? <a href="inscription">Je m'inscris.</a></p>

<!--<div id="inscrire-social" class="flex-center">
    <p>S'inscrire avec :</p>
</div>
<div class="socials-icon">
    <div class="cirle-social"><i class="fab fa-facebook-f"></i></div>
    <div class="cirle-social"><i class="fab fa-twitter"></i></div>
    <div class="cirle-social"><i class="fab fa-google-plus-g"></i></div>
</div>-->

<script src="js/signin_login_validation.js"></script>
</main>
