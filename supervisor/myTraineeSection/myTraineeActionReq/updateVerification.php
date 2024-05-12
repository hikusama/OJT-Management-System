<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
  header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user_id =  intval($_SESSION['user_id']);
    require_once '../myTrModel.php';

    $superVid = getSupId($pdo, $user_id);

    $conftopass = $_POST["conftopass"];
    $studId =  intval($_POST['studId']);


    $errors = [];

    try {
        require_once 'actionfunc.php';
        require_once 'dropMyTrainee.php';
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
            drop_my_tr($pdo,$studId,$superVid);
            echo 'You Are Verified';
        }
    } catch (PDOException $e) {
        die("Query Deletion Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
