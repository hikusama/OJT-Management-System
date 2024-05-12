<?php


declare(strict_types=1);


function get_user(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username";
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
function get_un_byid(object $pdo, int $user_id)
{
    $query = "SELECT * FROM users WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['username'];
}
function is_userpassword_wrong(string $userpassword, string $hashedPassword)
{
    if ($hashedPassword === null) {
        return true;
    }
    return !password_verify($userpassword, $hashedPassword);
}

function is_inputs_empty($userpassword)
{
    if (empty($userpassword)) {
        return true;
    } else {
        return false;
    }
}





