<main>
    <div class="forgot-content">
        <?php if(isset($message)) echo $message;?>
        <?php if($code_recover){?>
                    <form  role="form" action="<?= Config::$root ?>forget" autocomplete="off" class="" method="post">
                <div class="flex-center"><p>Vous pouvez réinitialiser votre mot de passe ici.</p></div>
                <div class="flex-center">
                    <input class="input" id="newPasseword" name="newPasseword" minlength="6" placeholder="nouveau mot de passe" type="password">
                </div>
                <div class="flex-center">
                    <input class="input"  id="confirmNewpasseword" name="confirmNewpasseword" minlength="6" placeholder="confirmer votre nouveau mot de passe"  type="password">
                </div>
                <div class="flex-center">
                    <input class="btn-full-2"  name="submitNewpassword" value="Envoyer" type="submit">
                </div>
            </form>

        <?php }else {?>

            <form  role="form" action="<?= Config::$root ?>forget" autocomplete="off" class="" method="post">
                <div class="flex-center">
                <input class="input"  id="email" name="email_recuperation" placeholder="adresse email" type="email">
                </div>
                
                <div class ="flex-center">
                <input class="btn-full-2"  name="recover_submit"  value="Envoyer" type="submit">
                </div>
            </form>
        <?php }?>
        <div class="flex-center"><?php if(isset($errors)){echo'<br><span style="color:red">'.$errors.'</span>';}else{echo'<br/>';}?></div>
    </div>
    <div id="triangle-bottomleft"></div>
    <div id="triangle-bottomright"></div>  
    <script src="<?= Config::$root ?>js/signin_login_validation.js"></script>
</main>