<?php

class Model {

  private $_connexion;
  private $_configuration = array();
  private $_table;

  public function __construct() {
    /* récupérer les infos config pour créer la connexion */
    try {
      $this->_connexion = new PDO("mysql:host=$host;dbname=$db", $username, $password);
      $this->_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      print "Connexion réussie";
    }
    catch(PDOException $e) {
      print "Erreur de connexion : " . $e->getMessage();
    }
    
  }

}