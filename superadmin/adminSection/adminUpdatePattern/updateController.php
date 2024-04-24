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
    string $position,
    string $department
) {
    if (
        empty($firstname) ||
        empty($lastname) ||
        empty($position) ||
        empty($department) 
    ) {
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

function update_Login_Cred_UserN_Only(
    object $pdo,
    int $key,
    string $username
){
    update_Only_Username_Cred(
        $pdo,
        $key,
        $username
    );
}

function update_Login_Cred_Pw_Only(
    object $pdo,
    int $key,
    string $userpassword
){
    update_Only_Pw_Cred(
        $pdo,
        $key,
        $userpassword
    );
}


function updateLoginCredAll(
    object $pdo,
    int $key,
    string $username,
    string $userpassword
) {

    update_Cred(
        $pdo,
        $key,
        $username,
        $userpassword
    );
}


function updatePersonal(
    object $pdo,
    int $key,
    string $ImageData,
    string $firstname,
    string $lastname,
    string $position,
    string $department
) {

    set_update_personal_info(
        $pdo,
        $key,
        $ImageData,
        $firstname,
        $lastname,
        $position,
        $department
    );
}
