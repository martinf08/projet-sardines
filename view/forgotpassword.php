<main>
 <?php if(isset($message)) echo $message;?>
  <?php if($code_recover){?>

    <form  role="form" action="<?=PUBLIC_URL?>forget" autocomplete="off" class="" method="post">
        <div class="flex-center"><p>Vous pouvez réinitialiser votre mot de passe ici.</p></div>
        <div class="flex-center">
            <input class="input" id="newPasseword" name="newPasseword" placeholder="nouveau mot de passe" type="password">
        </div>
        <div class="flex-center">
            <input class="input"  id="confirmNewpasseword" name="confirmNewpasseword" placeholder="confirmer votre nouveau mot de passe"  type="password">
        </div>
        <div class="flex-center">
            <input class="btn-full-signup"  name="submitNewpassword" value="Enoyer" type="submit">
        </div>
    </form>

  <?php }else {?>

    <form  role="form" action="<?=PUBLIC_URL?>forget" autocomplete="off" class="" method="post">
        <div class="flex-center">
          <input class="input"  id="email" name="email_recuperation" placeholder="adresse email" type="email">
        </div>
        
        <div class ="flex-center">
          <input class="btn-full-signup"  name="recover_submit"  value="Enoyer" type="submit">
        </div>
    </form>
  <?php }?>
  <div class="flex-center"><?php if(isset($errors)){echo'<br><span style="color:red">'.$errors.'</span>';}else{echo'<br/>';}?></div>
  </main>