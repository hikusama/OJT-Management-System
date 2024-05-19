<?php

use function PHPSTORM_META\type;

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}


require_once '../../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sup_Id = $_POST['sup_Id'];

    require_once '../homeModel.php';

    $studId = getStudId($pdo, intval($_SESSION["user_id"]));




    try {
 
        $type = get_userType($pdo,$studId);

        if ($type == 'notTrainee') {
            echo 'Please refresh your page you are now a NOT-TRAINEE';
            $_SESSION["accesstype"] = $type;
        
        }else if ($type == 'notDeployed') {
            reqToSupervisorExecute($pdo, $studId,$sup_Id);

            
        }else if ($type == 'deployed') {
            echo 'Please refresh your page you are now a TRAINEE';
            $_SESSION["accesstype"] = $type;


        }



    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
