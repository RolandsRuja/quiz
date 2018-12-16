<?php
/*
 * Tests class
 * */
class Tests
{
    /*
     * Private properties of tests class
     * */
    private $conn;
    private $table_name = "test";

    /*
     * Public properties of tests class
     * */
    public $id;
    public $name;

    /*
     * Creates connection with database for every Test object
     * */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*
     * Returns all tests
     * */
    function read()
    {
        $query = "SELECT * FROM $this->table_name 
                  ORDER BY name";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        return $sql;
    }

    /*
     * Returns all questions for selected test
     * */
    function getQuestions($id)
    {
        $query = "SELECT * FROM question
                  WHERE test_id = $id
                  ORDER BY id";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        return $sql->fetchAll();
    }

    /*
     * Returns all answers for selected question
     * */
    function getAnswers($id)
    {
        $query = "SELECT * FROM answer
                  WHERE question_id = $id
                  ORDER BY id";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        return $sql->fetchAll();
    }
}