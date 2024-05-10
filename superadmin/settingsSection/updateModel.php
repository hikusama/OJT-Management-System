<?php

declare(strict_types=1);




function get_username(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function update_Only_Username_Cred(object $pdo, int $key, string $username)
{
    $query = "UPDATE users SET username = :username WHERE user_id = :key";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":key", $key);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
}

function update_Only_Pw_Cred(object $pdo, int $key, string $userpassword)
{

    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($userpassword, PASSWORD_BCRYPT, $options);
    $query = "UPDATE users SET password = :userpassword WHERE user_id = :key";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":key", $key);
    $stmt->bindParam(":userpassword", $hashedPassword);
    $stmt->execute();
}


function update_Cred(object $pdo, int $key, string $username, string $userpassword)
{
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($userpassword, PASSWORD_BCRYPT, $options);
    $query = "UPDATE users SET username = :username, password = :userpassword WHERE user_id = :key";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":key", $key);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":userpassword", $hashedPassword);
    $stmt->execute();
}





