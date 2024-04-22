<?php

require_once '../../includes/config.php';
// require_once '../includes/session.php';
// session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = intval($_POST["student_id"]);
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $middlename = $_POST["middlename"];
    $year_level = $_POST["year_level"];

    $year = ['1st Year', '2nd Year', '3rd Year', '4rth Year'];

    $errors = [];
    try {

        require_once 'signup_model.php';
        require_once 'signup_contr.php';

        if (!in_array($year_level, $year)) {
            $errors['year_level_invalid'] = "Invalid Year level";
        }


        if (is_empty_firstSection(
            $student_id,
            $firstname,
            $lastname,
            $middlename,
            $year_level,
        )) {
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        if (is_studentid_invalid($student_id)) {
            $errors["invalid_studid"] = "Student id must integer Integer!";
        }
        if (is_studentId_taken($pdo, $student_id)) {
            $errors["studid_taken"] = "User ID already registered!";
        }




        if (!$errors) {
            echo 'Ready to next';
        } else {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }
    } catch (PDOException $e) {
        echo 'Query Failed: ' . $e->getMessage();
    }
} else {
    header("Location: ../index.php");
    die();
}
