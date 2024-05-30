<?php
declare(strict_types=1);


 


function getSupId(object $pdo, int $uid) : int
{
    $sql = "SELECT supervisor_info_id FROM supervisors 
    INNER JOIN users on users.user_id = supervisors.users_id
    where users.user_id = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['supervisor_info_id'];
}

function isPendingStat(object $pdo) 
{
    $sql = "SELECT * FROM reports 
    where report_status = 'Pending'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? true : false;
}

