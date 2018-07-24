<?php

class UserManager extends Model {
  
  public function getUser() {
    /* pseudocode
    req = dbConnect().query() */
  }
  
  public function getAllUsers() {
    
  }
  
  public function insertUser() {
    

    print_r($_POST);
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
          if($_POST['password'] === $_POST['confirmPassword']){
            
            $data =array(
              'email' => $_POST['email'],
              'password' => $_POST['password'],
              'nickname' => $this->nickname_generator
            );
            $this->saveData($data);
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
  function nickname_generator(){
   
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
/**------------fin de la classe ------------------ */
}