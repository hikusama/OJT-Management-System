<?php

declare(strict_types=1);




function is_empty_inputs(
    string $firstname,
    string $lastname,
    string $middlename,
    string $email,
    string $position,
    string $department,
    string $room,
    string $gender,
    string $username,
    string $userpassword
) {
    if (
        empty($firstname) ||
        empty($lastname) ||
        empty($middlename) ||
        empty($email) ||
        empty($position) ||
        empty($department) ||
        empty($room) ||
        empty($gender) ||
        empty($username) ||
        empty($userpassword)
    ) {
        return true;
    } else {
        return false;
    }
}


function is_email_registered(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_invalid_email(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}


function is_username_taken(object $pdo, string $username)
{
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}


function is_password_not_matched(string $confirm_password, string $userpassword)
{
    if ($confirm_password !== $userpassword) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $userpassword,string $email)
{
    set_user($pdo, $username, $userpassword, $email);
    $users_id = $pdo->lastInsertId();
    return $users_id;
}


function setupCoor(
    object $pdo,
    string $ImageData,
    string $firstname,
    string $lastname,
    string $middlename,
    string $email,
    string $position,
    string $department,
    string $room,
    string $gender,
    string $username,
    string $userpassword
) {

    $usrId = create_user($pdo,  $username,  $userpassword, $email);

    set_user_info(
        $pdo,
        $usrId,
        $ImageData,
        $firstname,
        $lastname,
        $middlename,
        $position,
        $department,
        $room,
        $gender
    );
}
