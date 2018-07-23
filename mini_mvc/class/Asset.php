<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 16/07/18
 * Time: 14:22
 */

class Asset
{
    private $_id_asset;
    private $_value;
    private $_description;
    private $_entry_date;
    private $_removal_date;
    private $_tag;
    private $_id_user;
    private $_user_email;
    private $_id_type;
    private $_id_quality;
    private $_name_id_type;
    private $_name_id_quality;
    private $_id_staff;

    public function __construct($datas)
    {
        //Hydrate
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        //$this->setRandomTag();
    }

    public function getId()
    {
        return $this->_id_asset;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getEntryDate()
    {
        return $this->_entry_date;
    }

    public function getRemovalDate()
    {
        return $this->_removal_date;
    }

    public function getTag()
    {
        return $this->_tag;
    }

    public function getIdUser()
    {
        return $this->_id_user;
    }

    public function getUserEmail()
    {
        return $this->_user_email;
    }

    public function getIdType()
    {
        return $this->_id_type;
    }

    public function getIdQuality()
    {
        return $this->_id_quality;
    }

    public function getNameIdType()
    {
        return $this->_name_id_type;
    }

    public function getNameIdQuality()
    {
        return $this->_name_id_quality;
    }

    public function getIdStaff()
    {
        return $this->_id_staff;
    }

    public function setId($id)
    {
        if (isset($id) && !empty($id) && is_int($id)) {
            $this->_id_asset = $id;
        }
    }

    public function setValue($value)
    {
        if (isset($value) && !empty($value)) {
            $this->_value = (int)$value;
        }
    }

    public function setDescription($description)
    {
        if (isset($description) && !empty($description) && is_string($description)) {
            $this->_description = $description;
        }
    }

    public function setEntryDate($date)
    {
        if (isset($date) && !empty($date)) {
            $this->_entry_date = $date;
        }
    }

    public function setRemovalDate($date)
    {
        if (isset($date) && !empty($date)) {
            $this->_removal_date = $date;
        }
    }

    public function setTag($tag)
    {
        if (isset($tag) && !empty($tag)) {
            $this->_tag = $tag;
        }
    }

    public function setIdUser($id)
    {
        if (isset($id) && !empty($id)) {
            $this->_id_user = $id;
        }
    }

    public function setUserEmail($email)
    {
        if (isset($email) && !empty($email)) {
            $this->_user_email = $email;
        }
    }

    public function setIdType($id)
    {
        if (isset($id) && !empty($id)) {
            $this->_id_type = (int)$id;
        }
    }

    public function setIdQuality($id)
    {
        if (isset($id) && !empty($id)) {
            $this->_id_quality = (int)$id;
        }
    }

    public function setNameIdType($type)
    {
        if (isset($type) && !empty($type)) {
            $this->_name_id_type = $type;
        }
    }

    public function setNameIdQuality($quality)
    {
        if (isset($quality) && !empty($quality)) {
            $this->_name_id_quality = $quality;
        }
    }

    public function setIdStaff($id)
    {
        if (isset($id) && !empty($id)) {
            $this->_id_staff = $id;
        }
    }

    public function setRandomTag()
    {
        $tag = (string)rand(1, 999999);
        $nb_turn = 6 - strlen($tag);
        for ($i = 0; $i < $nb_turn; $i++) {
            $tag = '0' . $tag;
        }
        $this->setTag($tag);
    }
}
