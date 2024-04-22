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
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $contact = intval($_POST["contact"]);
    $address = $_POST["address"];
    $course = $_POST["course"];
    $department = $_POST["department"];
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];
    $confirm_password = $_POST["confirm_password"];




    $errors = [];
    try {
        require_once 'signup_model.php';
        require_once 'signup_contr.php';


        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $fileSize = $_FILES['image']['size']; // Size of the uploaded file in bytes

            $maxFileSize = 1 * 1024 * 1024;

            if (in_array($fileExtension, $allowedExtensions)) {
                if ($fileSize <= $maxFileSize) {
                    $ImageData = file_get_contents($_FILES['image']['tmp_name']);
                } else {
                    $errors["pic_error"] = "The file size exceeds the maximum allowed limit (1 MB)!";
                }
            } else {
                $errors["pic_error"] = "Only JPG and PNG files are allowed for profile pictures!";
            }
        } else {
            $errors["pic_error"] = "Please choose a profile pic!";
        }

        if (is_empty_inputs(
            $student_id,
            $username,
            $userpassword,
            $firstname,
            $lastname,
            $middlename,
            $email,
            $address,
            $contact,
            $year_level,
            $course,
            $department,
            $gender
        )) {
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        if (is_studentid_invalid($student_id)) {
            $errors["invalid_studid"] = "Student id must integer Integer!";
        }
        if (is_invalid_email($email)) {
            $errors["invalid_email"] = "Please input valid email!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_registered"] = "Email has been already registered!";
        }

        // if(is_userInput_int($contact)){
        //     $errors["int_input"] = "Please input contact number!";
        // }
        if (is_password_not_matched($confirm_password, $userpassword)) {
            $errors["not_matched"] = "Password not matched!";
        }

        if (!$errors) {

            create_user_info(
                $pdo,
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
                $gender,
                $username,
                $userpassword
            );
            echo 'Account Created Successfully';
        } else {
            foreach ($errors as $error) {
                echo '<h4 class="formError" style="color:red;font-family:sans-serif;">' . $error . '</h4>';
            }
        }
        // $user_id = create_user(
        //     $pdo,
        //     $username,
        //     $userpassword
        // );

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
