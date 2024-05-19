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
function isTraineeExist(object $pdo, int $studId, int $superVid)
{
    $sql = "SELECT trainee.stu_id FROM trainee 
    where trainee.stu_id = :studId
    and trainee.supervisor_info_id = :superVid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId);
    $stmt->bindParam(':superVid', $superVid);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    } else {
        return false;
    }
}


function countMyTrainee(object $pdo, int $superVid)
{

    $sql = "SELECT COUNT(*) AS my_trainee_total from trainee
    INNER join supervisors ON trainee.supervisor_info_id = supervisors.supervisor_info_id
    where supervisors.supervisor_info_id = :superVid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $totr = $result['my_trainee_total'];

    if ($totr <= 5) {
        return null;
    } else {
        return $totr;
    }
}


function isOnReq(object $pdo, int $studId, int $superVid, int $reqId)
{

    $sql = "SELECT * FROM request 
where request.supervisor_id  = :superVid 
and request.stu_id  = :studId 
and request.request_id = :reqId 
and request.request_status = 'Pending'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':reqId', $reqId, PDO::PARAM_INT);
    $stmt->bindParam(':studId', $studId, PDO::PARAM_INT);
    $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    }else{
        return false;
    }


}
