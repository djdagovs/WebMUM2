<?php

class User
{
    public $UID;
    public $EMAIL;
    public $PASSWORD;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function isUserLogin()
    {
        if (isset($_SESSION['username']) and $_SESSION['username'] != '') {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        return false;
    }
}
