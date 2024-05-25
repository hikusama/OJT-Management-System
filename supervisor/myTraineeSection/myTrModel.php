<?php

declare(strict_types=1);




function getSupId(object $pdo, int $uid)
{
    $sql = "SELECT * FROM users 
    INNER JOIN supervisors on users.user_id = supervisors.users_id
    where users.user_id = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['supervisor_info_id'];
}
function getDeptAcr(object $pdo, string $dept)
{
    $sql = "SELECT * FROM department 
    INNER JOIN students on department.department = students.department
    where department.department = :dept";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':dept', $dept);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['deptAcronym'];
}

function executeOpenAttendaceByOne(object $pdo, int $trId)
{
    $sql = "UPDATE trainee 
    set  trainee.attendance_access = 'Open'
    where trainee.trainee_id = :trId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':trId', $trId);
    $stmt->execute();
}

function executeOpenAttendaceToAll(object $pdo, int $superVid)
{
    $sql = "UPDATE trainee 
    set  trainee.attendance_access = 'Open'
    where trainee.supervisor_info_id = :superVid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':superVid', $superVid);
    $stmt->execute();
}


function executeCloseAttendaceByOne(object $pdo, int $trId, int $supId)
{
    $sql = "UPDATE trainee 
    set  trainee.attendance_access = 'Close'
    where trainee.trainee_id = :trId 
    and trainee.supervisor_info_id = :supId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':trId', $trId);
    $stmt->bindParam(':supId', $supId);
    $stmt->execute();
}

function executeCloseAttendaceToAll(object $pdo, int $superVid)
{
    $sql = "UPDATE trainee 
    set  trainee.attendance_access = 'Close'
    where trainee.supervisor_info_id = :superVid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':superVid', $superVid);
    $stmt->execute();
}


function execute_one_time_out_traineeAttendance(object $pdo, int $trId, int $superVid)
{

    date_default_timezone_set('Asia/Manila');
    // $current_time = date('H:i');
    $current_time = time_controll();


    $lunch_time = '12:00';
    $entry_time = '08:00';
    $afternoon_time = '13:00';
    $dismiss_time = '17:00';
    $sql = '';

    if ($current_time < $afternoon_time && $current_time >= $entry_time) {

        if ($current_time >= $lunch_time) {
            $sql = "UPDATE attendance
        INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
        SET attendance.Mtime_out = '12:00:00'
        WHERE attendance.trainee_id = :trId
        AND attendance.Mtime_in = is not null
        AND trainee.supervisor_info_id = :superVid";
        } else {
            $sql = "UPDATE attendance
        INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
        SET attendance.Mtime_out = NOW()
        WHERE attendance.trainee_id = :trId
        AND attendance.Mtime_in = is not null
        AND trainee.supervisor_info_id = :superVid
        ";
        }
    } else if ($current_time >= $afternoon_time && $current_time <= $dismiss_time) {
        $sql = "UPDATE attendance
        INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
        SET attendance.Atime_out = NOW()
        WHERE attendance.trainee_id = :trId
        AND attendance.Atime_in = is not null
        AND trainee.supervisor_info_id = :superVid";
    } else {
        $sql = "UPDATE attendance
        INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
        SET attendance.Atime_out = '17:00:00'
        WHERE attendance.trainee_id = :trId
        AND attendance.Atime_in = is not null
        AND trainee.supervisor_info_id = :superVid
        ";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':trId', $trId, PDO::PARAM_INT);
    $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
    $stmt->execute();
}



function execute_all_time_out_traineeAttendance(object $pdo, int $superVid)
{
    date_default_timezone_set('Asia/Manila');
    $current_time = time_controll();

    $lunch_time = '12:00';
    $entry_time = '08:00';
    $afternoon_time = '13:00';
    $dismiss_time = '17:00';

    $sql = '';
    if ($current_time < $afternoon_time && $current_time >= $entry_time) {
        if ($current_time >= $lunch_time) {
            $sql = "UPDATE attendance
            INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
            SET attendance.Mtime_out = '12:00:00'
            WHERE trainee.supervisor_info_id = :superVid
            AND attendance.Mtime_in is not null";
        } else {
            $sql = "UPDATE attendance
            INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
            SET attendance.Mtime_out = NOW()
            WHERE trainee.supervisor_info_id = :superVid
            AND attendance.Mtime_in is not null";
        }
    } else if ($current_time >= $afternoon_time && $current_time <= $dismiss_time) {
        $sql = "UPDATE attendance
            INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
            SET attendance.Atime_out = now()
            WHERE trainee.supervisor_info_id = :superVid
            AND attendance.Atime_in is not null";
    } else {
        $sql = "UPDATE attendance
            INNER JOIN trainee ON trainee.trainee_id = attendance.trainee_id
            SET attendance.Atime_out = '17:00:00'
            WHERE trainee.supervisor_info_id = :superVid
            AND attendance.Atime_in is not null";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':superVid', $superVid);
    $stmt->execute();
}
 



// function countMyTrainee(object $pdo)
// {


//     $user_id =  intval($_SESSION['user_id']);

//     require_once '../reqModel.php';

//     $superVid = getSupId($pdo, $user_id);


//     $sql = "SELECT COUNT(*) AS my_trainee_total from trainee
//     INNER join supervisors ON trainee.supervisor_info_id = supervisors.supervisor_info_id
//     where supervisors.supervisor_info_id = :superVid";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
//     $stmt->execute();

//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     $totr = $result['my_trainee_total'];

//     return $totr;
// }