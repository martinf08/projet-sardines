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
            $user = $this->getRowdata("users", "email="."'".$_POST["email"]."'");
            // user check
            if($user['id_user']){
              echo "This email already exists";
            }else{
              // password check
              if($_POST['password'] === $_POST['confirmPassword']){
                $this->saveData('users',$_POST);
              }else{
                echo "mot de passe non identique";
              }
            }
      }
      
  }
}
?>
