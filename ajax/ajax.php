<?php

require_once "../config/db.php";
require_once "../models/History.php";
require_once "../models/User.php";

$db = new Database();
$conn = $db->getConnection();

/*
 * Calls of the functions depending on $_POST["action"] value received from ajax requests
 * */
if ($_POST) {
    switch ($_POST["action"]) {
        case "createHistory":
            $history = new History($conn);
            $history->create();
            break;
        case "updateUser":
            $user = new User($conn);
            if($user->update($_POST["user_id"], $_POST["correct"])) {
                echo "good";
            } else echo "bad";
            break;
    }
}