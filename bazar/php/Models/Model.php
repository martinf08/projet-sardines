<?php

/*
*
* Page de la production finale
* toute page n'ayant pas ce message sera considérée comme page de test
*
*/

require_once 'php/Classes/Config.php';

class Model {

  private $_connexion;
  //private $_configuration = array();
  private $_table;

  public function __construct() {
    /* récupérer les infos config pour créer la connexion */
    try {
      $this->_connexion = new PDO('mysql:host='.Config::$config['host'].';dbname='.Config::$config['db'].';',
                                                Config::$config['username'], Config::$config['password']);
      $this->_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      print "Connexion réussie";
    }
    catch(PDOException $e) {
      print "Erreur de connexion : " . $e->getMessage();
    }
  }
/*
  public function test() {
    return $_table;
  }*/

}