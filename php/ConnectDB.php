<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 29/06/18
 * Time: 16:25
 */

class ConnectDB extends mysqli
{
    protected $_host = 'localhost';
    protected $_user = 'root';
    protected $_password = '';
    protected $_database = 'sardines';

    public function __construct()
    {
        try {
            parent::__construct($this->_host, $this->_user, $this->_password, $this->_database);

        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }
}