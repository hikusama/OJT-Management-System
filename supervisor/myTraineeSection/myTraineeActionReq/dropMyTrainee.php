<?php

declare(strict_types=1);
 

function drop_my_tr(object $pdo,int $studId,int $supId)  {


    $sql = "UPDATE trainee 
    SET  trainee.supervisor_info_id = null 
    where trainee.stu_id = :studId and trainee.supervisor_info_id = :supId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId, PDO::PARAM_INT);
    $stmt->bindParam(':supId', $supId, PDO::PARAM_INT);
    $stmt->execute();
    

}