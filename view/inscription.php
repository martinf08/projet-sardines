
<main>
<!-- Main -->
<!-- avatar -->
<form method="POST" action="insertUser"> 
    <div id="centre-avatar">
        <div class="user-img" ><label for="user-img" id="user-icon"><img src="./images/ressources/user.png" alt="user" class="img-inscription"></label></div>
        <input type="file" name="avatar" accept="image/*" id="avatar"/>
    </div>


    <br/> <!-- Optionnel -->


    <div class="form-input">
        <i class="fas fa-envelope"></i>
    <input type="email" id="email" name="email" placeholder="johndoe@mail.com" required>

    </div>

    <br/> <!-- Optionnel -->
    
    <div class="form-input">
        <i class="fas fa-lock"></i>
        <input type="password" id="password" name="password" minlength="6" placeholder="......." required>
    </div>

    <br/> <!-- Optionnel -->

    <div class="form-input">
        <i class="fas fa-lock"></i>
        <input type="password" id="confirmPassword" name="confirmPassword" minlength="6" placeholder="Confirm password" required>
    </div>

    <br/> <!-- Optionnel -->


    <input type="submit" id="submit-signin" name="submit-signin" value="S'inscrire">

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

<script src="js/signin_validation.js"></script>
</main>