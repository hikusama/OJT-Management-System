<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}


require_once '../../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once '../homeModel.php';

    $studId = getStudId($pdo, intval($_SESSION["user_id"]));
    $traineeId = getTraineeId($pdo, intval($studId));

    date_default_timezone_set('Asia/Manila');
    // $current_time = date('H:i');
    $current_time = time_controll();

    $lunch_time = '12:00';
    $entry_time = '08:00';
    $afternoon_time = '13:00';
    $dismiss_time = '17:00';

    $timeArg = '';
    $timeInType = '';

    if ($current_time > $entry_time && $current_time < $lunch_time) {
        $timeInType = 'M';
        $timeArg = ($current_time <= '08:10:00') ? '08:00:00' : $current_time;
    } else {
        $timeInType = 'A';
        $timeArg = ($current_time <= '13:10:00') ? '13:00:00' : $current_time;
    }


    try {
        if (checkAttendance($pdo, $studId)) {


            if (!(($current_time > $lunch_time && $current_time < $afternoon_time) || ($current_time >= $dismiss_time))) {
                if (!isAlready_Timein($pdo, $studId)) {
                    time_inExecute($pdo, $traineeId, $studId, $timeArg, $timeInType);
                    echo 'time in successfully';
                } else {
                    echo 'already time in';
                }
            }
        } 
    } catch (PDOException $e) {
        die("Query Failed1: " . $e->getMessage());
    }
}
