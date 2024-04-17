<?php

require_once '../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION["username_data"] = "cent";
        $username =  $_SESSION["username_data"];
        $conftopass = $_POST["conftopass"];
        $usrId = $_POST["userId"];

        $errors = [];
        try {
            require_once 'actionfunc.php';
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
                echo '<p class="successresp" style="color:green;font-family:sans-serif;">You Are Verified!!</p>';

            }
        } catch (PDOException $e) {
            die("Query Deletion Failed: " . $e->getMessage());
        }




    
} else {
    header("Location: ../../index.php");
    die();
}
