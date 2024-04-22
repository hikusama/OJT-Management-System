<?php

declare(strict_types=1);




/*

-------------------------------First Section-----------------------------

*/

function is_empty_firstSection(
    int $student_id,
    string $firstname,
    string $lastname,
    string $middlename,
    string $year_level
) {
    if (
        empty($student_id) ||
        empty($firstname) ||
        empty($lastname) ||
        empty($middlename) ||
        empty($year_level)
    ) {
        return true;
    } else {
        return false;
    }
}

function is_studentid_invalid(string $student_id)
{
    if (!is_numeric($student_id)) {
        return true;
    } else {
        return false;
    }
}

function is_studentId_taken(object $pdo, int $student_id)
{
    if (get_student_id($pdo, $student_id)) {
        return true;
    } else {
        return false;
    }
}





/*

-------------------------------2nd Section-----------------------------

*/

function is_contact_invalid(string $contact)
{
    if (!is_numeric($contact)) {
        return true;
    } else {
        return false;
    }
}



function is_empty_secondSection(
    string $gender,
    string $email,
    string $contact,
    string $address,
    string $course,
    string $department
) {
    if (
        empty($gender) ||
        empty($email) ||
        empty($contact) ||
        empty($address) ||
        empty($course) ||
        empty($department)
    ) {
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
function is_email_registered(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}




/*

-------------------------------last Section-----------------------------

*/

function is_empty_lastSection(
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


function is_password_length_invalid($userpassword){
    $lengthPw = strlen($userpassword);
    if ($lengthPw < 6 || $lengthPw > 8) {
        return true;
    }else{
        return false;
    }
}








/*

-------------------------------submitttttttt Section-----------------------------

*/



function is_empty_inputs(
    int $student_id,
    string $username,
    string $userpassword,
    string $firstname,
    string $lastname,
    string $middlename,
    string $email,
    string $address,
    int $contact,
    string $year_level,
    string $course,
    string $department,
    string $gender
) {

    if (
        empty($student_id) ||
        empty($firstname) ||
        empty($lastname) ||
        empty($middlename) ||
        empty($year_level) ||
        empty($username) ||
        empty($userpassword) ||
        empty($email) ||
        empty($address) ||
        empty($contact) ||
        empty($course) ||
        empty($department) ||
        empty($gender)
    ) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $userpassword)
{
    set_user($pdo, $username, $userpassword);
    $users_id = $pdo->lastInsertId();
    return $users_id;
}


function create_user_info(
    object $pdo,
    int $student_id,
    string $ImageData,
    string $firstname,
    string $lastname,
    string $middlename,
    string $email,
    int $contact,
    string $address,
    string $year_level,
    string $course,
    string $department,
    string $gender,
    string $username,
    string $userpassword

) {
    $user_id = create_user($pdo,$username,$userpassword);
    $user_id = intval($user_id);
    set_user_info(
        $pdo,
        $user_id,
        $student_id,
        $ImageData,
        $firstname,
        $lastname,
        $middlename,
        $email,
        $contact,
        $address,
        $year_level,
        $course,
        $department,
        $gender
    );
    
}
