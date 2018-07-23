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

           $errors=array();
            //email check
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL === false)){
                $errors[] = "email non valide";
            }
           
       
            if(empty($errors)){

                $email = htmlentities($_POST['email']);
                $user = $this->checkUser(array($email));
                  // user check
                if($user['id_user']){
                    echo "This email already exists";
                }else{
                  // password check
                  if($_POST['password'] === $_POST['confirmPassword'])

                    $this->saveData($_POST);
                    
                  }else{
                    echo "mot de passe non identique";
                  }
                }
            }

      }
      
  }
}
