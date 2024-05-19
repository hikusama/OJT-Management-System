<?php

declare(strict_types=1);


function get_user(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["user-role"] = $user["user_role"];

        // Debugging output
        error_log("User Role: " . $_SESSION["user-role"]);

        return $user;
    } else {
        // User not found
        return null;
    }
}
function get_stud_id(object $pdo, int $userId)
{
    $query = "SELECT * FROM users 
    INNER JOIN students on users.user_id = students.users_id
    WHERE users.user_id = :userId;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } else {
        return null;
    }
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

