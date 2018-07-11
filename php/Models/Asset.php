<?php

/*
*
* Page de la production finale
* toute page n'ayant pas ce message sera considérée comme page de test
*
*/

class Asset extends Model
{
    private $_asset_id;
    private $_asset_value;
    private $_description;
    private $_entry_date;
    private $_removal_date;
    
    public function getId()
    {
        return $this->_asset_id;
    }

    public function getAssetValue() {
        return $this->_asset_value;
    }
    public function getDescription() {
        return $this->_description;
    }
    public function getEntryDate() {
        return $this->_entry_date;
    }
    public function getRemovalDate() {
        return $this->_removal_date;
    }

    /* la valeur est potentiellement un float 
    (enfin c'est nous qui avons décidé ça)
    donc j'ai pas contrôlé par un is_int() mais j'ai p-e tord ? */
    public function setAssetValue($value) {
        if (isset($value) && !empty($value)) {
            $this->_asset_value = $value;
        }
    }
    public function setDescription($desc) {
        if (isset($desc) && is_string($desc) && !empty($desc)) {
            $this->_description = $desc;
        }
    }
}