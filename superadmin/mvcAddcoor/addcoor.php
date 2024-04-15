<?php

require_once '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $middlename = $_POST["mname"];
    $email = $_POST["email"];
    $position = $_POST["position"];
    $department = $_POST["department"];
    $room = $_POST["room"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];
    $confirm_password = $_POST["confirm_password"];
    $user_role;
    try {
        require_once 'addcoorModel.php';
        require_once 'addcoorController.php';

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
            $middlename,
            $email,
            $position,
            $department,
            $room,
            $gender,
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
                    $middlename,
                    $email,
                    $position,
                    $department,
                    $room,
                    $gender,
                    $username,
                    $userpassword
                );
                echo '<p class="formsuc" style="color:green;font-family:sans-serif;">success</p>';
            }
        }

        if (!$errors) {
            echo '<p class="setd" style="color:green;font-family:sans-serif;">All Set</p>';
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
