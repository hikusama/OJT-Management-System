<?php

require_once '../../includes/config.php';
// require_once '../includes/session.php';
// session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gender = $_POST["gender"];
    $contact = intval($_POST["contact"]);
    $address = $_POST["address"];
    $course = $_POST["course"];
    $department = $_POST["department"];

    $genderREq = ['Female', 'Male'];

    $errors = [];
    try {

        
        require_once 'signup_model.php';
        require_once 'signup_contr.php';


        if (in_array($gender, $genderREq)) {
        } else {
            $errors['gender_invalid'] = "Invalid Gender!";
        }


        if (is_empty_secondSection(
            $gender,
            $contact,
            $address,
            $course,
            $department
        )) {
            $errors["empty_inputs"] = "Please fill all fields!";
        }


        if (!$errors) {
            echo 'Ready to next';
        }else{
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }


    } catch (PDOException $th) {
        echo 'Query Failed: ' . $th->getMessage();
    }
} else {
    header("Location: ../index.php");
    die();
}
