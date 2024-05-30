
<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../../includes/config.php';

$department = $_SESSION['department'];

    $sql = "SELECT COUNT(*) AS total_rows FROM trainee
    inner join students on students.stu_id = trainee.stu_id
    where department = :department";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':department',$department);
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



