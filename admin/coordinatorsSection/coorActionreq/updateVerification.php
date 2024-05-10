<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id =  $_SESSION['user_id'];

        $conftopass = $_POST["conftopass"];
        $usrId = $_POST["userId"];

        $errors = [];
        try {
            require_once 'actionfunc.php';
            // para ma display sa view

            if (is_inputs_empty($conftopass)) {
                $errors["empty_inputs"] = "Please fill all fields!";
            }
            $getUnresult = get_un_byid($pdo, $user_id);

            $result = get_user($pdo, $getUnresult);
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
