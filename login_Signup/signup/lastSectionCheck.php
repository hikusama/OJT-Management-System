<?php

require_once '../../includes/config.php';
// require_once '../includes/session.php';
// session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conf_pw = $_POST["conf_pw"];


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

        if(is_empty_lastSection($username,$password)){
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        if (is_username_taken($pdo,$username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_password_not_matched($password,$conf_pw)) {
            $errors["pw_not_matched"] = "Password not matched!";
        }
        if (is_password_length_invalid($password) && !is_password_not_matched($password,$conf_pw)) {
            $errors["pw_invalid_length"] = "Password must 6-8 characters!";
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }else {
            echo 'All Set';
        }




    }catch(PDOException $th){
        echo 'Query Failed: ' . $th->getMessage();
    }















}