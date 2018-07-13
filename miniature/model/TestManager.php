<?php
require_once 'Manager.php';

class TestManager extends Manager {
  
  public function getName($id) {
    $conn = $this->dbConnect();
    // je vais lui demander de me donner le champ name d'un type
    $req = $conn->prepare('SELECT name FROM type WHERE id_type = ' . $id);
    $req->execute();
    $result = $req->fetch();
    unset($conn);
    unset($req);
    return $result;
  }

}