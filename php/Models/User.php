<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 09/07/18
 * Time: 15:19
 */

class User
{
    private $_user_id;
    private $_nickname;
    private $_mail;
    private $_avatar;
    private $_identifier;
    private $_account_creation_date;
    private $_last_connection;
    private $_password;
    private $_account_status;
    private $_role;

    public function getId()
    {
        return $this->_user_id;
    }

    public function getNickname() {
        return $this->_nickname;
    }
    public function getMail() {
        return $this->_mail;
    }
    public function getAvatar() {
        return $this->_avatar;
    }
    public function getIdentifier() {
        return $this->_identifier;
    }
    public function getAccountCreationDate() {
        return $this->_account_creation_date;
    }
    public function getLastConnection() {
        return $this->_last_connection;
    }
    public function getPassword() {
        return $this->_password;
    }
    public function getAccountStatus() {
        return $this->_account_status;
    }
    public function getUserRole() {
        return $this->_role;
    }

    public function setNickname($nickname) {
        if (isset($nickname) && is_string($nickname)) {
            $this->_nickname = $nickname;
        }
    }
    public function setMail($mail) {
        if (isset($mail) && is_string($mail)) {
            $this->_mail = $mail;
        }
    }
    public function setAvatar($avatar) {
        if (isset($avatar) && is_string($avatar)) {
            $this->_avatar = $avatar;
        }
    }
    public function setPassword($password) {
        if (isset($password) && is_string($password)) {
            $this->_password = $password;
        }
    }
    public function setAccountStatus($int_bool) {
        if (isset($int_bool) && is_int($int_bool)) {
            $this->_account_status = $int_bool;
        }
    }
    public function setUserRole($user_role) {
        if (isset($user_role) && is_string($user_role)) {
            $this->_role = $user_role;
        }
    }
}