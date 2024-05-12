<?php

declare(strict_types=1);


function reject_student(object $pdo, int $studId, int $reqId){
    $sql = "UPDATE trainee 
	INNER JOIN request ON trainee.stu_id = request.stu_id
    SET  request_status = 'Rejected'
    where trainee.stu_id = :studId and request.request_id = :reqId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':reqId', $reqId, PDO::PARAM_INT);
    $stmt->bindParam(':studId', $studId, PDO::PARAM_INT);
    $stmt->execute();

}
