<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id =  intval($_SESSION['user_id']);

    
    require_once '../myTrModel.php';
    
    $superVid = getSupId($pdo, $user_id);

    try {

        if (isset($_POST['toAll'])) {
            echo '<div class="forAll">
            <button id="closeForAllExe">Close For All</button>
            </div>';
        } else {
            if (isset($_POST['trainee_id'])) {
                $trainee_id = $_POST['trainee_id'];
                executeCloseAttendaceByOne($pdo, $trainee_id);
            }else{
                executeCloseAttendaceToAll($pdo,$superVid);
                echo '<p class="resClose">Attendance for your traine is now <span>"CLOSED"</span>.</p>';

            }
        }
    } catch (PDOException $t) {
        echo 'Quesry Failed: ' . $t->getMessage();
    }
}
