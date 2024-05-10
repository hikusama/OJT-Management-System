
<?php

require_once '../../../includes/config.php';


    $sql = "SELECT COUNT(*) AS total_rows FROM supervisors";

    try {
        $stmt = $pdo->prepare($sql);
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



