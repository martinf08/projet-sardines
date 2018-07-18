<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 16/07/18
 * Time: 14:26
 */

class AssetManager
{

    protected $_db;

    public function __construct(ConnectDb $db)
    {
        $this->setDb($db);
    }

    public function setDb($db)
    {
        if (isset($db) && !empty($db)) {
            $this->_db = $db;
        }
    }

    public function checkRandomTag(Asset $asset)
    {
        $tag = (int)$asset->getTag();

        $req = $this->_db->prepare('SELECT tag FROM asset WHERE tag = :tag');
        $req->bindParam(':tag', $tag);
        $req->execute();

        $reponse = $req->fetch();
        if ($reponse) {
            return false;
        } else {
            return true;
        }
    }

    public function insertAsset(Asset $asset)
    {

      /*  while ($this->checkRandomTag($asset) == false) {
            $asset->setRandomTag();
            var_dump($asset->getTag());
        }*/
        $description = $asset->getDescription(); //:description
        $tag = $asset->getTag(); //:tag
        $id_user = $asset->getIdUser(); //:id_user
        $id_type = $asset->getIdType(); //:id_type
        $id_quality = $asset->getIdQuality(); //:id_quality
        $id_staff = $asset->getIdStaff(); //:id_staff

        $req = $this->_db->prepare('INSERT INTO `asset`(`description`, `entry_date`, `tag`, `id_user`, `id_type`, `id_quality`, `id_staff`) VALUES (:description, NOW() , :tag, :id_user, :id_type, :id_quality, :id_staff)');
        $req->bindParam(':description', $description);
        $req->bindParam(':tag', $tag);
        $req->bindParam(':id_user', $id_user);
        $req->bindParam(':id_type', $id_type);
        $req->bindParam(':id_quality', $id_quality);
        $req->bindParam(':id_staff', $id_staff);
        //$req->execute();

    }
}