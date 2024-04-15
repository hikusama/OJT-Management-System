<?php

declare(strict_types=1);




function is_empty_update_user_inputs(
    string $username,
    string $userpassword
) {
    if (
        empty($username) ||
        empty($userpassword)
    ) {
        return true;
    } else {
        return false;
    }
}

function is_empty_update_personal_inputs(
    string $firstname,
    string $lastname,
    string $middlename,
    string $position,
    string $department,
    string $room,
    string $gender,
) {
    if (
        empty($firstname) ||
        empty($lastname) ||
        empty($middlename) ||
        empty($position) ||
        empty($department) ||
        empty($room) ||
        empty($gender)
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




function updatePersonal(
    object $pdo,
    int $key,
    string $ImageData,
    string $firstname,
    string $lastname,
    string $middlename,
    string $position,
    string $department,
    string $room,
    string $gender,
) {

    set_update_personal_info(
        $pdo,
        $key,
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
