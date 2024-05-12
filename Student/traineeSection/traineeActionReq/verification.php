<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id =  $_SESSION['user_id'];
    $username =  $_SESSION['username'];
    $studId =  intval($_POST['studId']);
    $conftopass = $_POST["conftopass"];


    
    
    
    $errors = [];
    
    try {
        require_once 'actionfunc.php';
        require_once 'request_to_student.php';
        require_once '../traineeModel.php';
        $superVid = getSupId($pdo, $user_id);

        
        if (is_inputs_empty($conftopass)) {
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        $result = get_user($pdo, $username);



        if (is_userpassword_wrong($conftopass, $result["password"])) {
            $errors["login_incorrect"] = "Wrong password!";
        }
        if (countMyTrainee($pdo, $superVid)) {
            $errors["limit_reached"] = "5 Trainee limit reached!";
        }


        if ($errors) {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        } else {
            request_to_trainee($pdo,$studId,$superVid,$_SESSION["user_role"]);
            echo 'You Are Verified';
        }
    } catch (PDOException $e) {
        die("Query Deletion Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
