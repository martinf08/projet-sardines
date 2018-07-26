
<!-- Main -->
    <!-- AVATAR -->
    <div class="flex-center">
        <img src="./images/ressources/user.png" alt="user" class="img-connexion">
    </div>


    <br/> <!-- Optionnel -->

    <form method="POST" action="log" enctype="multipart/form-data"> 
        <div class="form-input">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="johndoe@mail.com">
        </div>
        <br/> <!-- Optionnel -->


        <div class="form-input">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder=".......">
        </div>

        <br>
    
        <br/> <!-- Optionnel -->

        <div id="mdp-oublie" class="form-input"><a href="#">mot de passe oublié ?</a></div>

        <br/> <!-- Optionnel -->

        <div class="flex-center"><input type="submit" value="Se connecter"></div>

        <br/> <!-- Optionnel -->

    </form>
    <div id="inscrire-social" class="flex-center">
        <p>S'inscrire avec :</p>
    </div>
    <div class="socials-icon">
        <div class="cirle-social"><i class="fab fa-facebook-f"></i></div>
        <div class="cirle-social"><i class="fab fa-twitter"></i></div>
        <div class="cirle-social"><i class="fab fa-google-plus-g"></i></div>
    </div>

    <script src="js/verif_form.js"></script>

</main>
