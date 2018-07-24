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
      
       
        // user check
        if($this->checkUser($email)){
          echo "This email already exists";
        }else{
          // password check
          if($_POST['password'] === $_POST['confirmPassword']){
            
            if($this->checkName($this->nickname_generator())){
      
            }else{
             
               $data =array(
              'email' => $_POST['email'],
              'password' => $_POST['password'],
              'nickname' => $this->nickname_generator()
            );
        
              $this->saveData($data);
            }
            
          }else{
            echo "mot de passe non identique";
          }
        }
      }
      
    }
  
  }

  /**------------ nickname_generator ------------------ 
   *  4 characters: 2 lower-case alphabets and 2 digit
  */
  public function nickname_generator(){
   
    $character_set_array = array();
    $character_set_array[] = array('count' => 2, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
    $character_set_array[] = array('count' => 2, 'characters' => '0123456789');
    $temp_array = array();
    foreach ($character_set_array as $character_set) {
      for ($i = 0; $i < $character_set['count']; $i++) {
        $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
      }
    }
    shuffle($temp_array);
    return implode('', $temp_array);     
  }

  public function logIn(){
  
        /**
         * vérifier si l'utilisateur existe
         * si oui récupérer son status admin ou user
         */
        $user_Model=$this->loadModel("User");
        
        if($_POST){
             $email = $_POST['email'];
             $pass =  $_POST['password'];

            $user = $this->checkUser(array(
              'email'=> $email,
              'password_User'=>$pass
            ));
            
            if(empty($user)){
                echo $this->e404('Identifiant ou mot de passe incorrect');
            }else{
            
                header('Location: /');
            }  
        }  
        
      
    }











/**------------fin de la classe ------------------ */
}