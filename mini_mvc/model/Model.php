<?php

class Model {

  public function dbConnect() {
    $connexion = new PDO('mysql:host='.Config::$config['host'].';dbname='.Config::$config['db'].';',
                                       Config::$config['username'], Config::$config['password']);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connexion;
  }
  
}