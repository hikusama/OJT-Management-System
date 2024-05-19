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
    $reqId =  intval($_POST['reqId']);
    $reqFrom =  $_POST['reqFrom'];
    $conftopass = $_POST["conftopass"];


    
    
    
    $errors = [];
    
    try {
        require_once 'actionfunc.php';
        require_once 'admit.php';
        require_once 'reject.php';
        require_once '../reqModel.php';
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
        if ($reqFrom == 'Admit') {
            if (isTraineeExist($pdo, $studId,$superVid)) {
                $errors["trainee_exist"] = "Already your trainee!";
            } 
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        } else {
            if (isOnReq( $pdo,  $studId,  $superVid,  $reqId)) {
            if ($reqFrom == 'Admit') {
                admit_trainee($pdo, $studId, $superVid, $reqId);
            }else if($reqFrom == 'Reject'){
                reject_student($pdo,$studId,$reqId,$superVid);
            }
            echo 'You Are Verified';
        }else{
            echo 'Request Not Found..';
        }

        }
    } catch (PDOException $e) {
        die("Query Deletion Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../index.php");
    die();
}
