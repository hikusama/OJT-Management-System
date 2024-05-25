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

    date_default_timezone_set('Asia/Manila');
    // $current_time = date('H:i');
    $current_time = time_controll();

    $lunch_time = '12:00';
    $entry_time = '08:00';
    $afternoon_time = '13:00';
    $dismiss_time = '17:00';


    try {

        if (isset($_POST['toAll'])) {



            if (!($current_time > $dismiss_time)) {
                echo '<div class="forAll">
                <button id="openForAllExe">Open For All</button>
                </div>';
            } else {
                executeCloseAttendaceToAll($pdo, $superVid);
                echo '<p class="resClose">Have a <span>"GREAT NIGHT.."</span></p>';
            }
        } else {


            if (!($current_time > $dismiss_time)) {
                if (isset($_POST['trainee_id'])) {
                    $trainee_id = $_POST['trainee_id'];
                    executeOpenAttendaceByOne($pdo, $trainee_id);
                } else {
                    executeOpenAttendaceToAll($pdo, $superVid);
                    echo '<p class="resOpen">Attendance for your traine is now <span>"OPEN"</span></p>';
                }
            } else {
                executeCloseAttendaceToAll($pdo, $superVid);
                echo '<p class="resClose">Have a <span>"GREAT NIGHT.."</span></p>';
            }
        }
    } catch (PDOException $t) {
        echo 'Quesry Failed: ' . $t->getMessage();
    }
}
