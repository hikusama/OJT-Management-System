<?php

declare(strict_types=1);



function reqForTraineeExecute(object $pdo, int $studId)
{

    $sql = "INSERT INTO request(stu_id,request_status,requested_to)
    VALUE (:studId,'Pending', 'Management')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return null;
    }
}
function reqToSupervisorExecute(object $pdo, int $studId, int $superVId)
{

    $sql = "INSERT INTO request(stu_id,supervisor_id,request_status,requested_to)
    VALUE (:studId,:superVId,'Pending', 'Supervisor')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId);
    $stmt->bindParam(':superVId', $superVId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return null;
    }
}

function getStudId(object $pdo, int $uid)
{
    $sql = "SELECT stu_id FROM users 
    INNER JOIN students on users.user_id = students.users_id
    where users.user_id = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['stu_id'];
}


 

function isRequested(object $pdo, int $studId)
{
    $sql = "SELECT * FROM request 
    where request.requested_to = 'Management'
    and request.stu_id = :studId 
    and request.request_status = 'Pending'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result !== false;
}

function get_userType(object $pdo, int $studentId): string
{
    $sql = "SELECT * FROM trainee WHERE trainee.stu_id = :studentId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
        return "notTrainee";
    }elseif ($result['supervisor_info_id'] === null) {
        return "notDeployed";
    } else {
        return "deployed";
    }
}


 

function checkAttendance(object $pdo, int $studentId){
    
    $sql = "SELECT * FROM trainee 
    WHERE trainee.stu_id = :studentId
    and trainee.attendance_access = 'Open'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result !== false;


}

function time_inExecute(){
    
    $sql = "INSERT INTO(trainee_id)";




}