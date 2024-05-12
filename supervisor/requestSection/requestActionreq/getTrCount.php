<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id =  intval($_SESSION['user_id']);

    require_once '../reqModel.php';

    $superVid = getSupId($pdo,$user_id);


    $sql = "SELECT COUNT(*) AS my_trainee_total from trainee
    INNER join supervisors ON trainee.supervisor_info_id = supervisors.supervisor_info_id
    where supervisors.supervisor_info_id = :superVid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $totr = $result['my_trainee_total'];

    
    
    if ($result) {
        
        if ($totr <= 5) {
            echo '<h3>'. $result['my_trainee_total'].'/5</h3>';
        }else{
            echo '<h3> style="color:red;"'. $result['my_trainee_total'].'/5</h3>';

        }
        echo '<p>My Total Trainee</p>';


    }
    
    

}
 
