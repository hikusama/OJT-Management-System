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



    if ($current_time > $entry_time && $current_time < $afternoon_time) {
        $timeInType = 'M';
        $timeArg =  '12:00:00';
    } else {
        $timeInType = 'A';
        $timeArg = ($current_time >= $dismiss_time) ? '17:00:00'  : $current_time;
    }




    try {

        if (checkAttendance($pdo, $studId)) {

            if ($current_time >= $lunch_time && $current_time < $afternoon_time || ($current_time >= $dismiss_time)) {
                if (!isAlready_TimeOut($pdo, $studId)) {
                    time_outExecute($pdo, $studId, $timeArg, $timeInType);
                    time_acq($pdo, $studId);
                    echo 'success';
                } else {
                    echo 'alreadytimeout';
                }
            }
        }




        echo isAlready_TimeOut($pdo, $studId);
    } catch (PDOException $e) {
        die("Query Failed1: " . $e->getMessage());
    }
}
