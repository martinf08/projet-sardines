<?php

class AssetManager extends Model {

  public function insertAsset(Asset $asset)
  {
      do {
          $asset->setRandomTag();

      } while ($this->checkRandomTag($asset) == false);

      $value = $asset->getValue();
      $description = $asset->getDescription(); //:description
      $tag = $asset->getTag(); //:tag
      $id_user = $asset->getIdUser(); //:id_user
      $id_type = $asset->getIdType(); //:id_type
      $id_quality = $asset->getIdQuality(); //:id_quality
      $id_staff = $asset->getIdStaff(); //:id_staff

      $req = $this->dbConnect()->prepare('INSERT INTO `asset`(`value`,`description`, `entry_date`, `tag`, `id_user`, `id_type`, `id_quality`, `id_staff`) VALUES (:value, :description, NOW() , :tag, :id_user, :id_type, :id_quality, :id_staff)');
      $req->bindParam(':value', $value);
      $req->bindParam(':description', $description);
      $req->bindParam(':tag', $tag);
      $req->bindParam(':id_user', $id_user);
      $req->bindParam(':id_type', $id_type);
      $req->bindParam(':id_quality', $id_quality);
      $req->bindParam(':id_staff', $id_staff);
      
      $result = $req->execute();

      # GESTION D'ERREUR
      if($result) {
          header('Location: index.php'); # remplacer par une page 'transaction réussie'
      } else {
        throw new Exception('L\'insertion d\'un nouveau matériel a échoué.');
      }
  }

  public function checkRandomTag(Asset $asset)
    {
        $tag = (int)$asset->getTag();

        $req = $this->dbConnect()->prepare('SELECT tag FROM asset WHERE tag = :tag');
        $req->bindParam(':tag', $tag);
        $req->execute();

        $reponse = $req->fetch();
        if ($reponse) {
            return false;
        } else {
            return true;
        }
    }
}