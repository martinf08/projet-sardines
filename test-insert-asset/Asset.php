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
    private $_id_type;
    private $_id_quality;
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

    public function getIdType()
    {
        return $this->_id_type;
    }

    public function getIdQuality()
    {
        return $this->_id_quality;
    }

    public function getIdStaff()
    {
        return $this->_id_staff;
    }

}
