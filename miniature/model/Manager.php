<?php
require_once './class/Config.php';

class Manager {

  protected function dbConnect() {
    try {
      $connexion = new PDO('mysql:host='.Config::$config['host'].';dbname='.Config::$config['db'].';',
                                                Config::$config['username'], Config::$config['password']);
      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $connexion; //fonctionne
    }
    catch(PDOException $e) {
      print "Erreur de connexion : " . $e->getMessage();
    }
  }
  
}