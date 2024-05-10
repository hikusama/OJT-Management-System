<?php

declare(strict_types=1);




function get_username(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function get_email(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}





function set_user(object $pdo, string $username, string $userpassword,string $email)
{
    $user_role = "Admin";
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($userpassword, PASSWORD_BCRYPT, $options);
    $query = "INSERT INTO users (username, password, user_role,email) VALUES (:username, :userpassword, :user_role,:email);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":userpassword", $hashedPassword);
    $stmt->bindParam(":user_role", $user_role);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    
}




function set_user_info(
    object $pdo,
    string $users_id,
    string $ImageData,
    string $firstname,
    string $lastname,
    string $position,
    string $department,
) {

    $query = "INSERT INTO admins (
    users_id, 
    profile_pic,
    firstname, 
    lastname, 
    position,
    department
    )

    VALUES (
    :users_id, 
    :ImageData, 
    :firstname, 
    :lastname, 
    :position,
    :department
    ) ;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":users_id", $users_id);
    $stmt->bindParam(":ImageData", $ImageData, PDO::PARAM_LOB);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":position", $position);
    $stmt->bindParam(":department", $department);
    $stmt->execute();
}

