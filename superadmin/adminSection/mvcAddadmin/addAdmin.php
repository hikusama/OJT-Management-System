<?php

require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $position = $_POST["position"];
    $department = $_POST["department"];
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];
    $confirm_password = $_POST["confirm_password"];
    $user_role;
    try {
        require_once 'addAdminModel.php';
        require_once 'addAdminController.php';

        $errors = [];

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
            $firstname,
            $lastname,
            $email,
            $position,
            $department,
            $username,
            $userpassword
        )) {
            $errors["empty_inputs"] = "Please fill all fields";
        }

        if (is_invalid_email($email)) {
            $errors["invalid_email"] = "Please input valid email!";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_password_length_invalid($userpassword) && !is_password_not_matched($userpassword, $confirm_password)) {
            $errors["pw_invalid_length"] = "Password must more than 6 characters!";
        }

        if (is_email_registered($pdo, $email)) {
            $errors["email_registered"] = "Email has been already registered!";
        }

        if (is_password_not_matched($confirm_password, $userpassword)) {
            $errors["not_matched"] = "Password not matched!";
        }
        if (isset($_POST['iseror']) && !$errors) {
            if ($_POST['iseror'] === 'gdtg') {
                setupCoor(
                    $pdo,
                    $ImageData,
                    $firstname,
                    $lastname,
                    $email,
                    $position,
                    $department,
                    $username,
                    $userpassword
                );
                echo 'success';
            }
        }

        if (!$errors) {
            if (!isset($_POST['iseror'])) {
                echo 'All Set';
            }
        } else {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }

        // Output response as JSON
    } catch (PDOException $th) {
        die("Query failed: " . $th->getMessage());
        // $response = array('success' => false, 'message' => 'Query Failed: ' . $th->getMessage());
    }
}
