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
        $this->EMAIL = strtolower($this->EMAIL);
        $emailInParts = explode("@", $this->EMAIL);
        if (count($emailInParts) !== 2) {
            return false;
        }
        $username = $emailInParts[0];
        $domain = $emailInParts[1];

        $user = $this->userExists($username, $domain);

        if (!is_null($user)) {
            if ($this->checkPassword($this->PASSWORD, $user)) {
                $_SESSION['username'] = $username;
                $_SESSION['domain'] = $domain;
                $_SESSION['usermail'] = $username."@".$domain;
                return true;
            }
        }
        return false;
    }

    private function getPasswordSchemaPrefix()
    {
        $map = array(
            'SHA-256' => '$5$rounds=5000$',
            'BLOWFISH' => '$2a$09$',
            'SHA-512' => '$6$rounds=5000$',
        );
        include 'config/config.php';

        $key = $config["password_hash_algorithm"];
        if(!isset($map[$key])){
            $key = 'SHA-512';
        }
        return $map[$key];
    }

    public function checkPassword($password, $hash)
    {
        return crypt($password, $hash) === $hash;
    }

    public function generatePasswordHash()
    {
        if(function_exists('mt_rand')){
            mt_srand(time());
            $num = mt_rand(1, 100000);
        }
        else{
            srand(time());
            $num = rand(1, 100000);
        }
        $salt = base64_encode($num);
        $schemaPrefix = $this->getPasswordSchemaPrefix();
        $hash = crypt($this->PASSWORD, $schemaPrefix.$salt.'$');
        return $hash;
    }

    public function userExists($username, $domain)
    {
        try {
            $stmt = $this->db->prepare('SELECT password FROM accounts WHERE username = ? AND domain = ?');
            $stmt->bindParam('1', $username);
            $stmt->bindParam('2', $domain);
            $stmt->execute();

            return $stmt->fetchObject()->password;
        } catch (PDOException $e) {
            $e->getMessage();
            return null;
        }

        return null;
    }

    public function changePassword()
    {
        $pwd = $this->generatePasswordHash();
        try {
            $stmt = $this->db->prepare('UPDATE accounts SET password = ? WHERE username = ? AND domain = ?');
            $stmt->bindParam('1', $pwd);
            $stmt->bindParam('2', $_SESSION['username']);
            $stmt->bindParam('3', $_SESSION['domain']);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }

        return false;
    }
}
