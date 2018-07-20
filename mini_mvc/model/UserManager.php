<?php

class UserManager extends Model {
  
  public function getUser() {
    /* pseudocode
    req = dbConnect().query() */
  }
  
  public function getAllUsers() {
    
  }
  
  public function insertUser() {
    
      if(isset($_POST)){

        //si 
            // vérification des mots de passe
            if($_POST['password'] === $_POST['confirmPassword']){
              
              $this->saveData('users',$_POST);

            }else{
              echo "mot de passe non identique";
            }

      }
      
  }
}
?>
