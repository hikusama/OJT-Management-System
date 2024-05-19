<?php

declare(strict_types=1);

function admit_trainee(object $pdo, int $studId, int $superVid, int $reqId)
{

        $sql = "UPDATE trainee 
	INNER JOIN request ON trainee.stu_id = request.stu_id
    SET trainee.supervisor_info_id = :superVid, 
    request_status = 'Accepted',
    request.respond_at = NOW(),
    trainee.duty_at = NOW()
    where trainee.stu_id = :studId 
    and request.request_id = :reqId 
    and request.request_status = 'Pending';
    
    
    DELETE FROM request 
        where request.request_status = 'Pending' 
        and request.stu_id = :studId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':reqId', $reqId, PDO::PARAM_INT);
        $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
        $stmt->bindParam(':studId', $studId, PDO::PARAM_INT);
        $stmt->execute();
 
}
