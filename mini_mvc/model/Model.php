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

    public function saveData($data){
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

                $sql='INSERT INTO users SET '.$data_fields;
                $req = $this->dbConnect()->prepare($sql);
                $req->execute($data_value);
    }
    public function getRowdata($table,$condition){

      $sql ='SELECT *FROM '.$table.' as ' .$table. ' WHERE '.$condition;
      $pre =$this->db->prepare($sql);
      $pre->execute();
      return $pre->fetchALL(PDO::FETCH_ASSOC); 

    }




  
}