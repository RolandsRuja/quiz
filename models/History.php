<?php

/*
 * History class
 * */
class History
{
    /*
     * Private properties of history class
     * */
    private $conn;
    private $table_name = "history";

    /*
     * Public properties of history class
     * */
    public $id;
    public $user_id;
    public $test_id;
    public $question_id;
    public $answer_id;

    /*
     * Creates connection with database for every History object
     * */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*
     * Inserts new Histroy object into database with values received from $_POST method
     * */
    function create()
    {
        $query = "INSERT INTO $this->table_name (user_id, test_id, question_id, answer_id)
                  VALUES (:user_id, :test_id, :question_id, :answer_id)";

        $sql = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($_POST["user_id"]));
        $this->test_id = htmlspecialchars(strip_tags($_POST["test_id"]));
        $this->question_id = htmlspecialchars(strip_tags($_POST["question_id"]));
        $this->answer_id = htmlspecialchars(strip_tags($_POST["answer_id"]));

        $sql->bindParam(":user_id", $this->user_id);
        $sql->bindParam(":test_id", $this->test_id);
        $sql->bindParam(":question_id", $this->question_id);
        $sql->bindParam(":answer_id", $this->answer_id);

        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

}