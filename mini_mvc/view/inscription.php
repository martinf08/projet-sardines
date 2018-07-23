
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inscription.css">
</head>
    <body>
        <header>
            <!-- Header -->
            <div class="fleche-retour"><i class="fas fa-arrow-left"></i></div>
            <h1>les sardines</h1>
        </header>
        <main>
            <!-- Main -->
            <!-- avatar -->
            <form method="POST" action="insertUser" enctype="multipart/form-data"> 
                <div id="centre-avatar">
                    <div class="user-img" ><label for="user-img" id="user-icon"><img src="./images/ressources/user.png" alt="user" class="img-inscription"></label></div>
                    <input type="file" name="avatar" accept="image/*" id="avatar"/>
                </div>


                <br/> <!-- Optionnel -->


                <div class="form-input">
                    <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="johndoe@mail.com">

                </div>

                <br/> <!-- Optionnel -->
                
                <div class="form-input">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder=".......">
                </div>

                <br/> <!-- Optionnel -->

                <div class="form-input">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                </div>

                <br/> <!-- Optionnel -->


                <input type="submit" value="Se connecter">

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

        </main>
        <footer>
            <!-- Footer -->
        </footer>
        <script src="js/inscription.js"></script>
    </body>
</html>

