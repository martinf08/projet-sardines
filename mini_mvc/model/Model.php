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
    }
  }
   /*---------------------------E2----------------------------------*/
  // cette fonction permet de d'ajouter dans la base des données stockées dans un array()
  public function saveData($data){
    $data_fields = array();
    $data_value = array();
  
    foreach ($data as $key => $value) {
      if($key != 'confirmPassword'){
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
      
    }
  }
  /*----------------------------E2---------------------------------*/
  //cette permet de vérifier l'existence de l'utilisateur
  public function checkUser($request){
    
    try {
      $pre = $this->dbConnect()->prepare("SELECT * FROM user where email = ?");
      $pre->execute($request);
      return $pre->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
      return $e->getMessage();
    }

  }
   /*----------------------------E2---------------------------------*/
  
  
  
  
}