<?php

class AssetManager extends Model
{
    public function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        $req = $this->dbConnect()->prepare($sql);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $req->fetchAll();
    }

    public function insertAsset(Asset $asset)
    {
        unset($_SESSION['lastAsset']);
        do {
            $asset->setRandomTag();
        } while ($this->checkRandomTag($asset) == false);
        $asset->setIdStaff(1235);
        $this->getValueWithQandT($asset); //Recovery the value
        $value = $asset->getValue();
        $description = $asset->getDescription(); //:description
        $tag = $asset->getTag(); //:tag
        $idType = $asset->getIdType(); //:id_type
        $idQuality = $asset->getIdQuality(); //:id_quality
        $idStaff = $asset->getIdStaff(); //:id_staff
        $idUser = (int) $asset->getIdUser();
        #With beneficiary

        if (is_int($idType) && is_int($idQuality)) {
            if (htmlspecialchars($_POST['beneficiary']) == 'withBeneficiary') {
                if (is_int($idUser)) {
                    #SEARCH ID USER WITH IDENTIFIER
                    if (isset($_POST['iduser']) && !empty($_POST)) {
                        $identifier = htmlspecialchars($_POST['iduser']);
                        $reqUser = $this->dbConnect()->prepare('SELECT id_user FROM `user` WHERE identifier = :id');
                        $reqUser->bindParam(':id', $identifier);
                        $reqUser->execute();
                        $responseUser = (int)$reqUser->fetch()['id_user'];
                        if ($responseUser) {
                            $asset->setIdUser($responseUser);
                            $idUser = $asset->getIdUser();
                        } else {
                            throw new Exception('L\'utilisateur n\'as pas été trouvé');
                        }

                        if ($this->checkIdentifier($_POST['iduser'])) {
                            $req = $this->dbConnect()->prepare('INSERT INTO `asset`(`value`,`description`, `entry_date`, `tag`, `id_user`, `id_type`, `id_quality`, `id_staff`) VALUES (:value, :description, NOW() , :tag, :id_user, :id_type, :id_quality, :id_staff)');
                            $req->bindParam(':value', $value);
                            $req->bindParam(':description', $description);
                            $req->bindParam(':tag', $tag);
                            $req->bindParam(':id_user', $idUser);
                            $req->bindParam(':id_type', $idType);
                            $req->bindParam(':id_quality', $idQuality);
                            $req->bindParam(':id_staff', $idStaff);
                            $result = $req->execute();
                            if ($result) {
                                $tag = $asset->getTag();
                                $req2 = $this->dbConnect()->prepare('SELECT id_asset FROM asset WHERE tag = :tag');
                                $req2->bindParam(':tag', $tag);
                                $req2->execute();
                                $asset->setId((int)$req2->fetch()['id_asset']);
                                $this->setIdTypeToName($asset); //Recovery name of type
                                $this->setIdQualityToName($asset); //Recovery name of quality
                                $this->setIdUserToEmail($asset); //Recovery email of user id
                                $this->setEntryDateById($asset); ////Recovery and set Entry_date in object
                                $_SESSION['lastAsset'] = $asset;

                                # CREDIT THE USER
                                $reqPay = $this->dbConnect()->prepare('UPDATE `user` SET `balance` = `balance` + :value WHERE `id_user` = :id_user');
                                $reqPay->bindParam(':value', $value);
                                $reqPay->bindParam(':id_user', $idUser);
                                $reqPay->execute();
                            }
                        }
                    }
                }
                #without Beneficiary
            } else if ($_POST['beneficiary'] == 'withoutBeneficiary') {
                $mailGhost = Config::$ghost;

                $req2 = $this->dbConnect()->prepare('SELECT id_user FROM `user` WHERE email = :email');
                $req2->bindParam(':email', $mailGhost);
                $req2->execute();
                $response = $req2->fetch()['id_user'];
                if ($response) {
                    $asset->setIdUser($response);
                    $idUser = $asset->getIdUser();
                    $req = $this->dbConnect()->prepare('INSERT INTO `asset`(`value`,`description`, `entry_date`, `tag`, `id_user`, `id_type`, `id_quality`, `id_staff`) VALUES (:value, :description, NOW() , :tag, :id_user, :id_type, :id_quality, :id_staff)');
                    $req->bindParam(':value', $value);
                    $req->bindParam(':description', $description);
                    $req->bindParam(':tag', $tag);
                    $req->bindParam(':id_user', $idUser);
                    $req->bindParam(':id_type', $idType);
                    $req->bindParam(':id_quality', $idQuality);
                    $req->bindParam(':id_staff', $idStaff);
                    $result = $req->execute();
                    if ($result) {
                        $tag = $asset->getTag();
                        $req2 = $this->dbConnect()->prepare('SELECT id_asset FROM asset WHERE tag = :tag');
                        $req2->bindParam(':tag', $tag);
                        $req2->execute();
                        $asset->setId((int)$req2->fetch()['id_asset']);
                        $this->setIdTypeToName($asset); //Recovery name of type
                        $this->setIdQualityToName($asset); //Recovery name of quality
                        $this->setIdUserToEmail($asset); //Recovery email of user id
                        $this->setEntryDateById($asset); //Recovery and set Entry_date in object
                        $_SESSION['lastAsset'] = $asset;
                    }
                }
            } else {
                throw new Exception('L\'utilisateur n\'existe pas');
            }
        } else {
            throw new Exception('Une donnée est incorrect');
        }
    }

    public function checkIdentifier($identifier)
    {
        if (isset($identifier) && !empty($identifier)) {
            $identifier = htmlspecialchars($identifier);
            $req = $this->dbConnect()->prepare('SELECT email FROM `user` WHERE identifier = :identifier');
            $req->bindParam(':identifier', $identifier);
            $req->execute();
            $response = $req->fetch();
            if ($response) {
                return true;
            }
        }
        return false;
    }

    public function setEntryDateById(Asset $asset)
    {
        $idUser = $asset->getIdUser();
        if ($idUser != null) {
            $req = $this->dbConnect()->prepare('SELECT entry_date FROM asset WHERE id_user = :id');
            $req->bindParam(':id', $idUser);
            $req->execute();
            $result = $req->fetch()['entry_date'];
            if ($result) {
                $asset->setEntryDate($result);
            }
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
            $req = $this->dbConnect()->prepare('SELECT quality.label FROM quality INNER JOIN asset ON quality.id_quality = asset.id_quality WHERE asset.id_asset = :id');
            $req->bindParam(':id', $id);
            $req->execute();
            $result = $req->fetch()['label'];
            if ($result) {
                $asset->setNameIdQuality($result);
            }
        }
    }

    public function setIdUserToEmail(Asset $asset)
    {
        $idUser = $asset->getIdUser();
        if ($idUser != null) {
            $req = $this->dbConnect()->prepare('SELECT email FROM user WHERE id_user = :id');
            $req->bindParam(':id', $idUser);
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

    public function getValueWithQandT(Asset $asset)
    {
        $quality = $asset->getIdQuality();
        $type = $asset->getIdType();
        $sql = $this->dbConnect()->prepare('SELECT price_catalog.value FROM price_catalog INNER JOIN type ON price_catalog.id_type = type.id_type INNER JOIN quality ON price_catalog.id_quality = quality.id_quality WHERE type.id_type = :id_type AND quality.id_quality = :id_quality');
        $sql->bindParam(':id_quality', $quality);
        $sql->bindParam(':id_type', $type);
        $sql->execute();

        $asset->setValue($sql->fetch()['value']);
    }
}