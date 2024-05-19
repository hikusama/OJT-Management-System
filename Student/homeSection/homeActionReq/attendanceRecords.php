<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "SuperAdmin")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id =  intval($_SESSION['user_id']);

    require_once '../homeModel.php';

    $studId = getStudId($pdo, intval($_SESSION["user_id"]));

    $sql = "SELECT *
        FROM attendance 
        LEFT JOIN  trainee on trainee.trainee = students.trainee 

        ORDER BY request.request_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {

        echo '                        
        <table>
        <tr>
            <th>Time in</th>
            <th>Time out</th>
            <th>Date</th>
        </tr>';
        foreach ($results as $result) {
 
?>
            <tr>
                <td><?php echo $result['time_in'] ?></td>
                <td><?php echo $result['time_out'] ?></td>
                <td><?php echo $result['day_date'] ?></td>
            </tr>
<?php
        }
        echo '</table>';
    } else {
        echo '<table>
        <tr>
            <th>Time in</th>
            <th>Time out</th>
            <th>Date</th>
        </tr>
        </table>
        <p class="noRec">No records yet.</p>';

    }
}
?>