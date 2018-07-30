<h2>Mot de passe oublié?</h2>
<p>Vous pouvez réinitialiser votre mot de passe ici.</p>
<div>
  <?php if($code_recover){?>

  <form  role="form" action="forget" autocomplete="off" class="" method="post">
      <div class="">
        <input id="newPasseword" name="newPasseword" placeholder="nouveau mot de passe" class="form-control"  type="email">
      </div>
      <div class="">
        <input id="confirmNewpasseword" name="confirmNewpasseword" placeholder="confirmer votre nouveau mot de passe" class="form-control"  type="email">
      </div>
      <div>
        <input name="submitNewpassword" class="btn btn-lg btn-primary btn-block" value="Enoyer" type="submit">
      </div>
    </form>

  <?php }else {?>
    <form  role="form" action="forget" autocomplete="off" class="" method="post">
      <div class="">
        <input id="email" name="email_recuperation" placeholder="adresse email" class="form-control"  type="email">
      </div>
      <div>
        <input name="recover_submit" class="btn btn-lg btn-primary btn-block" value="Enoyer" type="submit">
      </div>
    </form>
  <?php }?>
  <?php if(isset($errors)){echo'<br><span style="color:red">'.$errors.'</span>';}else{echo'<br/>';}?>