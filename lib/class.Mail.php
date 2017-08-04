<?php

class Mail
{
    public $NEWDOMAIN;
    public $DID;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function domainDependencies()
    {
        $domain = $this->getDomainByID()->domain;

        try {
            $stmt = $this->db->prepare('SELECT id FROM accounts WHERE domain = ?');
            $stmt->bindParam('1', $domain);
            $stmt->execute();

            if (isset($stmt->fetchObject()->id)) {
                return true;
            } else {
                try {
                    $stmt = $this->db->prepare('SELECT id FROM aliases WHERE source_domain = ?');
                    $stmt->bindParam('1', $domain);
                    $stmt->execute();

                    if (isset($stmt->fetchObject()->id)) {
                        return true;
                    } else {
                        return false;
                    }
                } catch (PDOException $e) {
                    $e->getMessage();
                    return false;
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }

        return true;
    }
    public function deleteDomain()
    {

        try {
            $stmt = $this->db->prepare('DELETE FROM domains WHERE id = ?');
            $stmt->bindParam('1', $this->DID);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
    public function getDomainByID()
    {
        try {
            $stmt = $this->db->prepare('SELECT domain FROM domains WHERE id = ?');
            $stmt->bindParam('1', $this->DID);
            $stmt->execute();

            return $stmt->fetchObject();
        } catch (PDOException $e) {
            $e->getMessage();
        }
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

    public function getDomains()
    {
        try {
            $stmt = $this->db->prepare('SELECT id, domain FROM domains');
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $e->getMessage();
        }
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
