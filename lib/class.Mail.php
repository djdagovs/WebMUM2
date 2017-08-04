<?php

class Mail
{
    public $NEWDOMAIN;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function existsDomain()
    {
        try {
            $stmt = $this->db->prepare('SELECT id FROM domains WHERE domain = ?');
            $stmt->bindParam('1', $this->NEWDOMAIN);
            $stmt->execute();

            if (isset($stmt->fetchObject()->id)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }

        return false;
    }

    public function createDomain()
    {
        try {
            $stmt = $this->db->prepare('INSERT INTO domains(domain) VALUES(?)');
            $stmt->bindParam('1', $this->NEWDOMAIN);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
}
