
<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../index.php');
}

require_once '../../../includes/config.php';
require_once '../../myTraineeSection/myTrModel.php';


$supvId = getSupId($pdo, $_SESSION['user_id']);

    $sql = "SELECT COUNT(*) AS total_rows FROM trainee
    where supervisor_info_id = :supvId";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':supvId',$supvId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalRows = $result['total_rows'];

        if ($totalRows) {
            echo $totalRows;
        }else{
            echo 0;
        }

    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        exit();
    } 



