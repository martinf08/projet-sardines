<?php

abstract class Model {
  
  public $table = false;
  
  
  
  public function __construct() {
    
    if($this->table===false){
      $this->table = strtolower(get_class($this));
      $this->table =str_replace("manager","",$this->table);
    } 
    
  }
  
  
  public function dbConnect() {
    try {
      $connexion = new PDO('mysql:host='.Config::$config['host'].';dbname='.Config::$config['db'].';',
      Config::$config['username'], Config::$config['password']);
      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $connexion;
    }
    catch(PDOException $e) {
      print "Erreur de connexion : " . $e->getMessage();
      die();
    }
  }
  /*---------------------------E2----------------------------------*/
  // cette fonction permet de d'ajouter dans la base des données stockées dans un array()
  public function saveData($data){
    $data_fields = array();
    $data_value = array();
    
    foreach ($data as $key => $value) {
      if($key !='confirmPassword'){
        $data_fields[] = "$key=:$key";  
        $data_value[":$key"] = $value; 
      }
    }
    
    $data_fields = implode(',',$data_fields);
    $sql='INSERT INTO '. $this->table.' SET '.$data_fields;
    
    try {
      $req = $this->dbConnect()->prepare($sql);
      $req->execute($data_value);
      
    }catch(PDOException $e){
      throw new Exception('ajout impossible');
    }
  }
  
  // voir pour dévélopper une suele function pour vérifier les différents champs
  /*----------------------------E2---------------------------------*/
  //cette permet de vérifier l'existence de l'utilisateur
  public function UserChecker($request){
    
    try {  
      $pre = $this->dbConnect()->prepare("SELECT * FROM user where email = :email");
      $pre->execute(array(':email' => $request));
      return $pre->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
      return $e->getMessage();
    }
    
  }
  /*----------------------------E2---------------------------------*/
  //cette permet de vérifier l'existence ou pas du checkName
  public function identifierChecker($request){
    
    try {
      $pre = $this->dbConnect()->prepare("SELECT * FROM user where identifier = :identifier");
      $pre->execute(array('identifier' =>$request));
      $pre->fetch(PDO::FETCH_ASSOC);
      if($pre){
        return false;
      }else{
        return true;
      }
      
    }catch(PDOException $e){
      return $e->getMessage();
    }
    
  }


  
 
  // select User rowdata
  public function selectUserrowdata($request){
 
    $pre = $this->dbConnect()->prepare("SELECT * FROM user where email = :email AND password = :password");
      $pre->execute(array(
        'email' =>htmlspecialchars($request['email']),
        'password' =>$request['password']
      ));
      $data = $pre->fetch(PDO::FETCH_ASSOC);
      $userdata = new stdClass();
      if($data){
        foreach ($data as $key => $value){
          if($key!="password"){
             $userdata->$key=$value;
          }
        }
        return $userdata;
      }
      return;
  }

  // user Connection
  public function userConnection($request){
    try {

      if($this->selectUserrowdata($request)){
        $lastlogin = date('Y-m-d H:i:s', time());
        $updatesql = "UPDATE user SET last_login='".$lastlogin."' WHERE email='".$request['email']."'";
        $query = $this->dbConnect()->prepare($updatesql);
        $query->execute(); 
        return $this->selectUserrowdata($request);
      }else{
         return;
      }

    }catch(PDOException $e){
      return $e->getMessage();
    }
    
  }
}