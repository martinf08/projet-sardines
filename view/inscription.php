
<main>
<!-- Main -->
<!-- avatar -->
<form method="POST" action="insertUser"> 
    <!--<div class="flex-center" id="centre-avatar">
        <div class="user-img" ><label for="user-img" id="user-icon"><img src="../images/normal.jpg" class="img-inscription"></label></div>
        <input type="file" name="avatar" accept="image/*" id="avatar"/>
    </div>-->


    <br/> <!-- Optionnel -->


    <div class="flex-center form-input">
        <i class="fas fa-envelope"></i>
    <input class="input" type="email" id="email" name="email" placeholder="e-mail" required>

    </div>

    <br/> <!-- Optionnel -->
    
    <div class="flex-center form-input">
        <i class="fas fa-lock"></i>
        <input class="input" type="password" id="password" name="password" minlength="6" placeholder="mot de passe" required>
        <div class="tooltip">entre au minimum 6 caractères</div>
    </div>

    <br/> <!-- Optionnel -->

    <div class="flex-center form-input">
        <i class="fas fa-lock"></i>
        <input class="input" type="password" id="confirmPassword" name="confirmPassword" minlength="6" placeholder="Confirmer votre mot de passe" required>
    </div>

    <br/> <!-- Optionnel -->

    <div class="flex-center">
        <input class="btn-full-signup" type="submit" name="submit-signin" value="S'inscrire">
    </div>
    

    <br/> <!-- Optionnel -->


</form>

<p>Vous avez déjà un compte <a href="connexion">connectez vous ici.</a></p>

<div id="inscrire-social" class="flex-center">
    <p>S'inscrire avec :</p>
</div>
<div class="socials-icon">
    <div class="cirle-social"><i class="fab fa-facebook-f"></i></div>
    <div class="cirle-social"><i class="fab fa-twitter"></i></div>
    <div class="cirle-social"><i class="fab fa-google-plus-g"></i></div>
</div>

<script src="<?=PUBLIC_URL?>js/signin_login_validation.js"></script>
</main>