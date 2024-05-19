<?php

declare(strict_types=1);


function executeAddTrainee(object $pdo, int $course_id)
{
    $findSql = "SELECT course FROM course where course_id = :course_id ";
    $stmtFind = $pdo->prepare($findSql);
    $stmtFind->bindParam(':course_id', $course_id);
    $stmtFind->execute();
    $resFindings = $stmtFind->fetch();
    $courseFind = $resFindings['course'];

    $findSql2 = "SELECT students.* FROM students where students.course = :courseFind ";
    $stmtFind2 = $pdo->prepare($findSql2);
    $stmtFind2->bindParam(':courseFind', $courseFind);
    $stmtFind2->execute();
    $studCrsResults = $stmtFind2->fetchAll();

    if ($studCrsResults) {

        foreach ($studCrsResults as $studCrsResult) {
            $ntr = $studCrsResult['stu_id'];
            $sql = "INSERT INTO trainee (stu_id) 
            SELECT :ntr 
            WHERE NOT EXISTS (SELECT 1 FROM trainee WHERE stu_id = :ntr);
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ntr', $ntr);
            $stmt->execute();
        }
    }
}


function executeAddTraineeByOne(object $pdo, int $student)
{



    $sql = "INSERT INTO trainee (stu_id) 
    SELECT :student 
    WHERE NOT EXISTS (SELECT 1 FROM trainee WHERE stu_id = :student);
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':student', $student);
    $stmt->execute();


    $sql2 = "UPDATE request 
    SET request_status = 'Accepted', 
        respond_at = NOW() 
    WHERE stu_id = :student 
    AND request_status = 'Pending'
    AND requested_to = 'Management';
    ";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':student', $student);
    $stmt2->execute();


    // $sql2 = "DELETE FROM request 
    // where request.request_status = 'Pending' 
    // and request.stu_id = :student";
    // $stmt2 = $pdo->prepare($sql2);
    // $stmt2->bindParam(':student', $student, PDO::PARAM_INT);
    // $stmt2->execute();
}
