<?php

class AssetManager extends Model
{
    public function getAll($table) {
        $sql = "SELECT * FROM $table";
        $req = $this->dbConnect()->prepare($sql);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $req->fetchAll();
    }

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
        if ($result) {
            $tag = $asset->getTag();
            $req2 = $this->dbConnect()->prepare('SELECT id_asset FROM asset WHERE tag = :tag');
            $req2->bindParam(':tag', $tag);
            $req2->execute();
            $asset->setId((int)$req2->fetch()['id_asset']);
            $this->setIdTypeToName($asset); //Recuperation nom du type
            $this->setIdQualityToName($asset); //Recuperation nom de la quality
            $this->setIdUserToName($asset); //Recuperation de l'email
            session_start();
            $_SESSION['lastAsset'] = $asset;

        }
    }

    public function setIdTypeToName(Asset $asset)
    {
        $id = $asset->getId();
        if ($id != null) {
            $req = $this->dbConnect()->prepare('SELECT type.name FROM type INNER JOIN asset ON type.id_type = asset.id_type WHERE asset.id_asset = :id ');
            $req->bindParam(':id', $id);
            $req->execute();
            $result = $req->fetch()['name'];
            if ($result) {
                $asset->setNameIdType($result);
            }
        }
    }

    public function setIdQualityToName(Asset $asset)
    {
        $id = $asset->getId();
        if ($id != null) {
            $req = $this->dbConnect()->prepare('SELECT quality.label FROM quality INNER JOIN asset ON quality.id_quality = asset.id_type WHERE asset.id_asset = :id');
            $req->bindParam(':id', $id);
            $req->execute();
            $result = $req->fetch()['label'];
            if ($result) {
                $asset->setNameIdQuality($result);
            }
        }
    }

    public function setIdUserToName(Asset $asset)
    {
        $id_user = $asset->getIdUser();
        if ($id_user != null) {
            $req = $this->dbConnect()->prepare('SELECT email FROM users WHERE id_user = :id');
            $req->bindParam(':id',$id_user );
            $req->execute();
            $result = $req->fetch()['email'];
            if ($result) {
                $asset->setUserEmail($result);
            }
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