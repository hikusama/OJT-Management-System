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


function set_update_personal_info(
    object $pdo,
    int $key,
    string $ImageData,
    string $firstname,
    string $lastname,
    string $position,
    string $department
) {
    $query = "UPDATE admins 
              SET 
                profile_pic = :ImageData,
                firstname = :firstname,
                lastname = :lastname,
                position = :position,
                department = :department
              WHERE 
              admin_info_id = :key";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":key", $key, PDO::PARAM_INT);
    $stmt->bindParam(":ImageData", $ImageData, PDO::PARAM_LOB);
    $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindParam(":position", $position, PDO::PARAM_STR);
    $stmt->bindParam(":department", $department, PDO::PARAM_STR);

    $stmt->execute();
}





// function set_user(object $pdo, string $username, string $userpassword)
// {
//     $user_role = "Supervisor";
//     $options = [
//         'cost' => 12
//     ];
//     $hashedPassword = password_hash($userpassword, PASSWORD_BCRYPT, $options);
//     $query = "INSERT INTO users (username, password, user_role) VALUES (:username, :userpassword, :user_role);";
//     $stmt = $pdo->prepare($query);
//     $stmt->bindParam(":username", $username);
//     $stmt->bindParam(":userpassword", $hashedPassword);
//     $stmt->bindParam(":user_role", $user_role);
//     $stmt->execute();
    
// }




// function set_user_info(
//     object $pdo,
//     string $users_id,
//     string $ImageData,
//     string $firstname,
//     string $lastname,
//     string $middlename,
//     string $email,
//     string $position,
//     string $department,
//     string $room,
//     string $gender
// ) {

//     $query = "INSERT INTO supervisors (
//     users_id, 
//     profile_pic,
//     firstname, 
//     lastname, 
//     middlename, 
//     email, 
//     position,
//     department, 
//     room, 
//     gender
//     )

//     VALUES (
//     :users_id, 
//     :ImageData, 
//     :firstname, 
//     :lastname, 
//     :middlename, 
//     :email, 
//     :position,
//     :department,
//     :room, 
//     :gender 
//     ) ;";

//     $stmt = $pdo->prepare($query);
//     $stmt->bindParam(":users_id", $users_id);
//     $stmt->bindParam(":ImageData", $ImageData, PDO::PARAM_LOB);
//     $stmt->bindParam(":firstname", $firstname);
//     $stmt->bindParam(":lastname", $lastname);
//     $stmt->bindParam(":middlename", $middlename);
//     $stmt->bindParam(":email", $email);
//     $stmt->bindParam(":position", $position);
//     $stmt->bindParam(":department", $department);
//     $stmt->bindParam(":room", $room);
//     $stmt->bindParam(":gender", $gender);
//     $stmt->execute();
// }
