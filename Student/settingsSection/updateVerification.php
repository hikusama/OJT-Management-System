<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../index.php');
}
require_once '../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username =  $_SESSION['username'];
    $conftopass = $_POST["conftopass"];


    $errors = [];

    try {
        require_once 'actionfunc.php';
        // require_once 'addtrainee.php';
        // para ma display sa view


        if (is_inputs_empty($conftopass)) {
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        $result = get_user($pdo, $username);

        if (is_userpassword_wrong($conftopass, $result["password"])) {
            $errors["login_incorrect"] = "Wrong password!";
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        } else {
            echo 'You Are Verified';
            
        }
    } catch (PDOException $e) {
        die("Query Deletion Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
