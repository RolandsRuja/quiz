<?php

session_start();
require_once "../config/db.php";
require_once "../models/User.php";
require_once "../models/Tests.php";

$db = new Database();
$conn = $db->getConnection();

$test = new Tests($conn);
$tests = $test->read();
?>

<?php include "layout/header.php"; ?>

<div class="container h-100">
    <div class="row h-75">
        <div class="col-md-4 text-center m-auto">
            <h1 class="header">Technical task</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="start-test">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter your name">
                    <div class="invalid-feedback">
                        Username must be 30 characters long or shorter.
                    </div>
                </div>
                <div class="form-group">
                    <select class="form-control" name="test_id" id="test-select">
                        <option value="" disabled selected>Choose test</option>
                        <?php foreach ($tests as $test) { ?>
                            <option value="<?= $test["id"] ?>"><?= $test["name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="button">Start</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "layout/footer.php"; ?>

<?php
/*  Creates new user if form was submitted*/
if($_POST) {
    $user = new User($conn);

    /*
     * If successfully created user, stores username, id and test_id in $_SESSION
     * and redirects to quiz view
     * */
    if ($user->create()) {
        $_SESSION["username"] = $user->username;
        $_SESSION["id"] = $user->getUserId();
        $_SESSION["test_id"] = $user->test_id;
        header('Location: quiz.php');
    }
}
?>
<script>
    /* initial values of user input  */
    var username = null;
    var test = null;

    /* Disables start button on page load  */
    $(document).ready(function(){
        $("#button").attr("disabled",true);
    });

    /* On each change in form takes new values of user input and calls input validation() */
    $("form :input").change(function () {
        username = $("#username").val();
        test = $("#test-select").val();
        validation();
    });

    /*  Validates user input in form */
    function validation() {
        /* Allows user to click on "Start" button if user input in form is valid */
        if (username !== null && username.length > 0 && username.length < 31 && test !== null) {
            $("#button").addClass("selected");
            $("#button").attr("disabled",false);
            usernameFeedback();
        } else {
            /* Disables button "Start" if user input is not valid and shows validation error if necessary */
            $("#button").removeClass("selected");
            $("#button").attr("disabled",true);
            usernameFeedback();
        }
    }
    /*
    * Shows message to user that username cant be longer than 30 characters
    * and hides it if username is in correct length
    * */
    function usernameFeedback() {
        if (username.length > 30) {
            $(".invalid-feedback").show();
        } else {
            $(".invalid-feedback").hide();
        }
    }
</script>