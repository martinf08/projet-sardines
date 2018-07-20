<?php

class UserManager extends Model {
  
  public function getUser() {
    /* pseudocode
    req = dbConnect().query() */
  }
  
  public function getAllUsers() {
    
  }
  
  public function insertUser($post) {
    
    $email = $_POST['email'];
    $avatar = $_POST['avatar'];
    $db = $this->dbConnect();
    
    //the form has been submitted with post
    
    // vérification des mots de passe
    if($_POST['password'] === $_POST['confirmPassword']){
      
  
      //Vérification de l'eixistace de l'utilisateur
      $sql = "SELECT * From users WHERE email= :email LIMIT 1";
      $objetPDO = $this->dbConnect()->prepare($sql);
      $objetPDO->bindParam(':email',  $email);
      $objetPDO->execute();
      $reponse = $objetPDO->fetch();
      if ($reponse) {
        // cet email exigiste déjà
        $_SESSION['message'] = 'cet email existe déjà';
      } else {
        
        //$_SESSION['username']=--> unique ID
        $_SESSION['email'] = $email;
        $_SESSION['avatar'] = $avatar;
        
        //insert user data into database
        $sql = "INSERT INTO users (username,email, password, avatar) VALUES (':username',':email', ':password', ':avatar_path')";
                                                                
        //check if mysql query is successful
        $query = $this->dbConnect()->prepare($sql);
        
        $query->excecute(array(
          ':username' => $username,
          ':email' => $email,
          ':password' => $password, 
          ':avatar' => $avatar)
        );
        
        if ($query=== true){
          send_validation($email);
          $_SESSION['message'] = "Inscription réussi!!";
          //redirect the user to welcome.php
          header("location: welcome.php");
        } else {
          $_SESSION['message'] = "Ajouté impossible à la base de données!";
          echo  "Ajouté impossible à la base de données!";
        }
      }
      
    }
    return false;
    
  }
}
?>
