<?php

declare(strict_types=1);
 

function request_to_trainee(object $pdo,int $studId,int $superVid,string $myRole)  {
 

    
    $sql = "INSERT 
    INTO request(request.supervisor_id,request.stu_id,request.request_status,request.requested_by) 
    VALUE (:superVid,:studId,'Pending',:myRole)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId, PDO::PARAM_INT);
    $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
    $stmt->bindParam(':myRole', $myRole, PDO::PARAM_STR);
    $stmt->execute();
    

}