<?php
declare(strict_types=1);




function executeSubmitReport( object $pdo,int $trid,string $ImageData,string $title,string $place,string $time_acquired ,string $narrative){
    $sql = "INSERT INTO reports(trainee_id ,pic_proof,title,place,time_acquired,narrative)
                    value(:trid,:pic_proof,:title,:place,:time_acquired,:narrative)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':trid',$trid);
    $stmt->bindParam(':pic_proof',$ImageData,PDO::PARAM_LOB);
    $stmt->bindParam(':title',$title);
    $stmt->bindParam(':place',$place);
    $stmt->bindParam(':time_acquired',$time_acquired);
    $stmt->bindParam(':narrative',$narrative);
    $stmt->execute();

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

function getTraineeId(object $pdo, $studentId): int
{
    $sql = "SELECT trainee_id FROM trainee 
    where trainee.stu_id = :studentId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['trainee_id'];
}
