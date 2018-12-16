<?php

require_once "Tests.php";

$db = new Database();
$conn = $db->getConnection();

/*
 * User class
 * */
class user {
    /*
     * Private properties of user class
     * */
    private $conn;
    private $table_name = "user";

    /*
     * Public properties of user class
     * */
    public $id;
    public $username;
    public $test_id;
    public $total;
    public $correct;

    /*
     * Creates connection with database for every User object
     * */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*
     * Inserts new User object into database with values received from $_POST method
     * */
    function create()
    {
        $query = "INSERT INTO $this->table_name (username, test_id, total)
                  VALUES (:username, :test_id, :total)";

        $sql = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($_POST["username"]));
        $this->test_id = htmlspecialchars(strip_tags($_POST["test_id"]));
        $this->total = $this->getQuestionCount($this->test_id);

        $sql->bindParam(":username", $this->username);
        $sql->bindParam(":test_id", $this->test_id);
        $sql->bindParam(":total", $this->total);

        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Updates value of correct answers for selected user
     * $id - user_id represents user
     * $correct - boolean value; 1 - if correct answer or 0 - if answer was incorrect
     * */
    function update($id, $correct)
    {
        $query = "UPDATE $this->table_name
                  SET correct = correct + $correct
                  WHERE id = $id";

        $sql = $this->conn->prepare($query);
        var_dump($sql);

        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Returns all questions that has relation with selected test
     * */
    function getQuestionCount($id)
    {
        $query = "SELECT * FROM question
                  WHERE test_id = $id
                  ORDER BY id";

        $sql = $this->conn->prepare($query);
        $sql->execute();
        return count($sql->fetchAll());
    }

    /*
     * Returns user id of last created user
     * */
    function getUserId()
    {
        return $this->conn->lastInsertId();
    }

    /*
     * Returns all data about selected user
     * */
    function getUser($id)
    {
        $query = "SELECT * FROM $this->table_name
                  WHERE id = $id";

        $sql = $this->conn->prepare($query);
        $sql->execute();
        return $sql->fetch();
    }
}