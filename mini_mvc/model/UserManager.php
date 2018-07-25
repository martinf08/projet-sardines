<?php

class UserManager extends Model {
  
  public function getUser() {
    /* pseudocode
    req = dbConnect().query() */
  }
  
  public function getAllUsers() {
    
  }
  
  public function insertUser(User $user) {
    
    
    $errors = array();
    //email check
    if(filter_var($user->getEmail(),FILTER_VALIDATE_EMAIL === false)){
      $errors[] = "email non valide";
    }
    
    
    if(empty($errors)){
      
      $email = htmlentities($user->getEmail());
      
      // user check
      if($this->UserChecker($user->getEmail())){
        echo "This email already exists";
      }else{
        // password check
        if($user->getPassword() === $user->getConfirmPassword()){
          
          $reponse = $this->identifierChecker($this->identiferGenerator());
          
          if($reponse){
            echo "identifier déjà utilisé";
          }else{
            
            $data =array(
              'email' => $user->getEmail(),
              'password' => $user->getPassword(),
              'identifier' => $this->identiferGenerator()
            );
            $this->saveData($data);
            return true;
          }
          
        }else{
          echo "mot de passe non identique";
        }
      }
    }
    die('usermana');
  }
  /**
   *  IdentiferGenerator 
   *  4 characters : 2 Lettres and 2 numbers
   */
  public function identiferGenerator(){

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
  
  
  
  /**
   * Login function
   */
  public function logIn(User $user){
    
    if($user->getPassword()!=null && filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)){

      $conx = $this->userConnection(array(
        'email'=> $user->getEmail(),
        'password'=>$user->getPassword()
      ));
      
      if(empty($conx)){
        echo ('Identifiant ou mot de passe incorrect');
        return false;
      }else{
    
        $user->setId_user($conx['id_user']);
        $user->setStaff($conx['staff']);
        $_SESSION['user'] = $user;
        return true;
      }  
    }
    
  }
  
  
  /**------------fin de la classe ------------------ */
}