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
    } elseif ($result['supervisor_info_id'] === null) {
        return "notDeployed";
    } else {
        return "deployed";
    }
}




function checkAttendance(object $pdo, int $studentId)
{
    $sql = "SELECT * FROM trainee 
    WHERE trainee.stu_id = :studentId
    and trainee.attendance_access = 'Open'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result !== false;
}


function isAlready_Timein(object $pdo, int $studentId): bool
{
    $sql = "SELECT 1 FROM attendance 
            WHERE attendance.day_date = CURRENT_DATE 
            AND (
                (attendance.Mtime_in IS NOT NULL AND attendance.Mtime_out IS NULL AND attendance.stu_id = :studentId) 
                OR 
                (attendance.Atime_in IS NOT NULL AND attendance.Atime_out IS NULL AND attendance.stu_id = :studentId)
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? true : false;
}

function waiting_for_aft(object $pdo, int $studentId)
{
    $sql = "SELECT 1 FROM attendance 
    WHERE attendance.day_date = CURRENT_DATE 
    AND attendance.Mtime_in IS NOT NULL 
    AND attendance.Mtime_out IS NOT NULL 
    AND attendance.Atime_in IS NULL 
    AND attendance.Atime_out IS NULL 
    AND attendance.stu_id = :studentId";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;

}
function waiting_nxt_morn(object $pdo, int $studentId)
{
    $sql = "SELECT 1 FROM attendance 
    WHERE attendance.day_date = CURRENT_DATE 
    AND attendance.Mtime_in IS NOT NULL 
    AND attendance.Mtime_out IS NOT NULL 
    AND attendance.Atime_in IS NOT NULL 
    AND attendance.Atime_out IS NOT NULL 
    AND attendance.stu_id = :studentId";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;

}



function isAlready_TimeOut(object $pdo, int $studentId)
{
    $sql = "SELECT 1 FROM attendance 
            WHERE attendance.day_date = CURRENT_DATE 
            AND (
                (attendance.Mtime_in IS NOT NULL AND attendance.Mtime_out IS NOT NULL AND attendance.stu_id = :studentId) 
                and
                (attendance.Atime_in IS NOT NULL AND attendance.Atime_out IS NOT NULL AND attendance.stu_id = :studentId)
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? true : false;
}



function time_inExecute(object $pdo, int $traineeId, int $studentId, string $timeArg, string $timeInType)
{
    $sql = '';
    if ($timeInType == "M") {
        $sql = "INSERT INTO attendance(trainee_id, stu_id, Mtime_in, day_date)
    VALUES (:traineeId,:studentId, :timeArg, CURRENT_DATE);";
    } else {
        $sql = "UPDATE attendance 
        SET Atime_in = :timeArg 
        WHERE stu_id = :studentId 
        AND day_date = CURRENT_DATE 
        AND Atime_out IS NULL;";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':timeArg', $timeArg);
    $stmt->bindParam(':studentId', $studentId);
    if ($timeInType == 'M') {
        $stmt->bindParam(':traineeId', $traineeId);
    }
    $stmt->execute();
}




function time_outExecute(object $pdo, int $studentId, string $timeArg, string $timeInType)
{
    $sql = '
    UPDATE attendance 
SET 
    Mtime_out = CASE WHEN :timeInType = "M" THEN :timeArg ELSE Mtime_out END,
    Atime_out = CASE WHEN :timeInType = "A" THEN :timeArg ELSE Atime_out END,
    mins_time_acquired = 
        CASE 
            WHEN :timeInType = "M" THEN TIMESTAMPDIFF(MINUTE, Mtime_in, :timeArg)
            WHEN :timeInType = "A" THEN TIMESTAMPDIFF(MINUTE, Atime_in, :timeArg)
        END
WHERE 
    stu_id = :studentId 
    AND day_date = CURRENT_DATE 
    AND (
        (:timeInType = "M" AND Mtime_out IS NULL AND Mtime_in IS NOT NULL) OR
        (:timeInType = "A" AND Atime_out IS NULL AND Atime_in IS NOT NULL)
    );';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':timeInType', $timeInType);
    $stmt->bindParam(':timeArg', $timeArg);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->execute();
}




function time_acq(object $pdo, int $studentId): void
{
    // Retrieve the attendance record
    $sql = "SELECT Mtime_in, Mtime_out, Atime_in, Atime_out FROM attendance 
            WHERE attendance.day_date = CURRENT_DATE 
            AND attendance.stu_id = :studentId";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Calculate time acquired in minutes
    $timeAcquiredMinutes = 0;

    if ($result) {
        // Calculate Morning Time Acquired
        if ($result['Mtime_in'] !== null && $result['Mtime_out'] !== null) {
            $timeAcquiredMinutes += calculateTimeInMinutes($result['Mtime_in'], $result['Mtime_out']);
        }

        // Calculate Afternoon Time Acquired
        if ($result['Atime_in'] !== null && $result['Atime_out'] !== null) {

            $timeAcquiredMinutes += calculateTimeInMinutes($result['Atime_in'], $result['Atime_out']);
        }
    }
    if ($timeAcquiredMinutes == 0) {
        $timeAcquiredMinutes = null;
    }

    $updateSql = "UPDATE attendance 
                  SET mins_time_acquired = :timeAcquiredMinutes 
                  WHERE day_date = CURRENT_DATE 
                  AND stu_id = :studentId";

    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindParam(':timeAcquiredMinutes', $timeAcquiredMinutes, PDO::PARAM_INT);
    $updateStmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $updateStmt->execute();
}






function calculateTimeInMinutes(string $timeIn, string $timeOut): int
{
    $timeInDateTime = new DateTime($timeIn);
    $timeOutDateTime = new DateTime($timeOut);

    $interval = $timeOutDateTime->diff($timeInDateTime);

    // Convert the interval to total minutes
    $minutes = ($interval->h * 60) + $interval->i + ($interval->s / 60);

    return (int)round($minutes);
}





// function update_time_inExecute(object $pdo, int $studentId)
// {

//     $sql = "UPDATE attendance
//     SET trainee_id
//     VALUE(:studentId);";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':studentId', $studentId);
//     $stmt->execute();
// }
