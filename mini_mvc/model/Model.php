<?php

class Model {

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

    // cette fonction permet de d'ajouter dans la base de données stockées dans un array()
    public function saveData($table,$data){
                $data_fields = array();
                $data_value = array();
                
                //if(isset($date->$key)) unset($date->$key);
                foreach ($data as $key => $value) {
                  if($key != 'confirmPassword'){
                    $data_fields[] = "$key=:$key";  
                    $data_value[":$key"] = $value; 
                  }
                }
                $data_fields = implode(',',$data_fields);
                $sql='INSERT INTO '.$table.' SET '.$data_fields;
                try {
                  $req = $this->dbConnect()->prepare($sql);
                  $req->execute($data_value);
                }catch(PDOException $e){

                }
    }

    public function getRowdata($table,$condition){

      $sql ='SELECT *FROM '.$table.' as Table_'.$table.' WHERE '.$condition;
     // die($sql);
      try {
        $pre = $this->dbConnect()->prepare($sql);
        $pre->execute();
        return $pre->fetch(PDO::FETCH_ASSOC); 
      }catch(PDOException $e){
        return $e->getMessage();
      }

      
    }




  
}