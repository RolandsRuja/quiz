<?php

/*
 * Database connection configuration
 * */

class Database
{
    /*
     * Database credentials
     * */
    private $host = "localhost";
    private $dbname = "quiz";
    private $username = "root";
    private $password = "";

    public $conn;

    /*
     * Creating connection with database
     * use $initial = true only when creating database not when inserting tables or data
     * */
    public function getConnection($initial = false)
    {
        $this->conn = null;

        try {
            if ($initial) {
                $this->conn = new PDO("mysql:host=$this->host", $this->username, $this->password);
            } else {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            }
        } catch (PDOException $e) {
            echo "Connection error: ".$e->getMessage();
        }

        return $this->conn;
    }
}