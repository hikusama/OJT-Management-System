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
    int $student_id,
    string  $firstname,
    string  $lastname,
    string  $middlename,
    string  $year_level,
    string  $gender,
    int $contact,
    string  $address,
    string  $department,
    string  $course
) {
    if (
        empty($student_id) ||
        empty($firstname) ||
        empty($lastname) ||
        empty($middlename) ||
        empty($year_level) ||
        empty($gender) ||
        empty($contact) ||
        empty($address) ||
        empty($department) ||
        empty($course)
    ) {
        return true;
    } else {
        return false;
    }
}

function is_studno_exist(object $pdo, int $studno)
{

    if (getStudNo($pdo, $studno)) {
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
function is_password_length_invalid($userpassword)
{
    $lengthPw = strlen($userpassword);
    if ($lengthPw < 6) {
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
) {
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
) {
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
    int $student_id,
    string $ImageData,
    string $firstname,
    string $lastname,
    string $middlename,
    int $contact,
    string $address,
    string $year_level,
    string $course,
    string $department,
    string $gender
) {

    set_update_personal_info(
        $pdo,
        $key,
        $student_id,
        $ImageData,
        $firstname,
        $lastname,
        $middlename,
        $contact,
        $address,
        $year_level,
        $course,
        $department,
        $gender
    );
}
