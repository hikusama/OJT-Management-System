<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}


require_once '../../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once '../homeModel.php';

    $studId = getStudId($pdo, intval($_SESSION["user_id"]));




    try {

        $sql = "SELECT * FROM request 
        where request.stu_id = :studId
        ORDER BY request.request_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':studId', $studId);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo '    <table>
            <th>Request Status</th>
            <th>Request Sent</th>
            <th>Request Respond</th>';
            foreach ($results as $result) {
                $stat = $result['request_status'];
                $colorStat;
                if ($stat == 'Accepted') {
                    $colorStat = '#0dae00';
                } elseif ($stat == 'Rejected') {
                    $colorStat = '#e60000';
                } elseif($stat == 'Pending') {
                    $colorStat = '#e68700';

                }else{
                    $colorStat = 'white';

                }
?>

                <tr>
                    <td style="color: <?php echo $colorStat ?>"><?php echo $result['request_status'] ?></td>
                    <td><?php echo $result['request_at'] ?></td>
                    <td><?php echo $result['respond_at'] ?></td>
                </tr>
<?php
            }
            echo '</table>';
        } else {
            echo '
            <table>
            <th>Request Status</th>
            <th>Request Sent</th>
            <th>Request Respond</th>
            <p>No record of request yet.</p>
            <table>';
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
