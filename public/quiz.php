<?php

session_start();
require_once "../config/db.php";
require_once "../models/Tests.php";

$db = new Database();
$conn = $db->getConnection();

$test = new Tests($conn);
$questions = $test->getQuestions($_SESSION["test_id"]);
?>

<?php include "layout/header.php"; ?>

<div class="container h-100">
    <div class="row h-75">
        <div class="col-md-8 m-auto">
            <?php
            $counter = 0;
            foreach ($questions as $question) { ?>
                <div class="row qa" id="question-<?= $counter++ ?>">
                    <div class="col-md-12 text-center question">
                        <h2><?= $question["question"] ?></h2>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            $answers = $test->getAnswers($question["id"]);
                            foreach ($answers as $answer) { ?>
                                <div class="col-md-6">
                                    <div class="card text-center answer" id="answer-<?= $answer["id"] ?>" onclick="value(<?= $answer["question_id"] ?>, <?= $answer["is_true"] ?>, <?= $answer["id"] ?>)">
                                        <h4><?= $answer["answer"] ?></h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"></div>
                    </div>
                </div>
                <div class="col-md-6 m-auto text-center">
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="button">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "layout/footer.php"; ?>
<script>
    /* Used to check if current question is last*/
    var total = <?= count($questions) - 1 ?>;

    /* Used in ajax function createHistory which stores in database user answers on each question*/
    var user_id = <?= $_SESSION["id"] ?>;
    var test_id = <?= $_SESSION["test_id"] ?>;
    var question_id = null;
    var answer_id = null;

    /* Keeps track on current question */
    var counter = 0;

    /* Value of correctness of current answer */
    var correct = null;


    /*  Disables "Next" button on page load, also gives initial values of Button text and progressbar width */
    $(document).ready(function () {
        changeButton();
        progressBar();
        $("#button").attr("disabled",true);
    });

    /* Enables button if user has answered on current question */
    $(".answer").on("click", function () {
       if (answered()) {
           $("#button").attr("disabled",false);
           $("#button").addClass("selected");
       }
    });

    /*  After user clicks on button  */
    $("#button").on("click", function () {

        /* Increment value of current question */
        counter++;

        /* Save user answer in database */
        createHistory();

        /* Update user value of correctly answered questions*/
        updateUser();

        /* Updates width of progressbar*/
        progressBar();

        /* If last question then changes button text to "Finish" */
        if (lastQuestion()) {
            changeButton(counter);
        }

        /* If answered on all questions redirect to result page*/
        if (counter === total + 1) {
            location.href = "result.php";
        } else {
            /* Shows next question */
            toggleQuestion(counter);
        }
    });

    /*  Changes text of the button depending on current question */
    function changeButton() {
        if (!lastQuestion()) {
            $("#button").text("Next");
        } else {
            $("#button").text("Finish");
        }
    }

    /*  Switches current question  */
    function switchQuestion(counter) {
        /* If current question is not the last question */
        if (!(counter === total + 1)) {
            toggleQuestion(counter);
            resetAnswer();
            resetButton();
        }
    }

    /*  Hides previous question and shows current question */
    function toggleQuestion(counter) {
        $("#question-" + (counter - 1)).hide();
        $("#question-" + counter).show();
    }

    /* Disables and removes selected class from button */
    function resetButton() {
        $("#button").attr("disabled", true);
        $("#button").removeClass("selected");
    }

    /*  Checks if its the last question  */
    function lastQuestion() {
        return (total === counter);
    }

    /*  Checks if current question is answered  */
    function answered() {
        return (correct !== null && correct <= 1 && correct >= 0);
    }

    /*  Updates width of the progress bar  */
    function progressBar() {
        $(".progress-bar").css("width", ((counter + 1) / (total + 1) * 100) + "%")
    }

    /*  Takes value of selected answer and add style to it  */
    function value(question, is_true, id) {
        correct = is_true;
        answer_id = id;
        question_id = question;
        addSelected(id);
    }

    /*  Adds new style to currently selected answer */
    function addSelected(id) {
        $(".answer").removeClass("selected");
        $("#answer-" + id).addClass("selected");
    }

    /* Resets all values of answer */
    function resetAnswer() {
        correct = null;
        answer_id = null;
        question_id = null;
    }

    /* AJAX function which saves users answer on current question of the test */
    function createHistory() {
        $.ajax({
            type: "POST",
            url: "../ajax/ajax.php",
            data: {
                action: 'createHistory',
                user_id: user_id,
                test_id: test_id,
                question_id: question_id,
                answer_id: answer_id
            }
        })
    }

    /* AJAX function which updates amount of correct answers */
    function updateUser() {
        $.ajax({
            type: "POST",
            url: "../ajax/ajax.php",
            data: {
                action: 'updateUser',
                user_id: user_id,
                correct: correct
            }
        })
    }
</script>