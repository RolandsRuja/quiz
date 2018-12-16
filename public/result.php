<?php
session_start();

require_once "../config/db.php";
require_once "../models/User.php";

$db = new Database();
$conn = $db->getConnection();

$user = new User($conn);
$user = $user->getUser($_SESSION["id"]);
?>
<?php include "layout/header.php"; ?>

<div class="container h-100">
    <div class="row h-75">
        <div class="col-md-8 m-auto text-center result">
            <h1>Thanks, <?= $user["username"] ?>!</h1>
            <p>You responded correctly to <?= $user["correct"] ?> out of <?= $user["total"] ?> questions.</p>
        </div>
    </div>
</div>

<?php include "layout/footer.php"; ?>