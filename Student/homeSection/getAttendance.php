<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../index.php');
}


require_once '../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'homeModel.php';

    $studId = getStudId($pdo, intval($_SESSION["user_id"]));

    $sql = "SELECT * FROM attendance
    WHERE attendance.stu_id = :studId
    ORDER BY day_date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    try {


        if ($results) {
            echo '
            <table>
            <th>Time-in</th>
            <th>Time-out</th>
            <th>Time-in</th>
            <th>Time-out</th>
            <th>Time Acquired</th>
            <th>Date</th>';
            foreach ($results as $result) {

                $Mtime_out = ($result['Mtime_out']) ? $result['Mtime_out'].'pm'  : '-';

                $Atime_in = ($result['Atime_in']) ? $result['Atime_in'].'pm' : '-';
                $Atime_out = ($result['Atime_out']) ? $result['Atime_out'].'pm'  : '-';
                
                $timeAcquired = ($result['mins_time_acquired']) ? number_format($result['mins_time_acquired'] / 60,1).'hrs'  : '-';

                echo '
            <tr>
                <td>'. $result['Mtime_in'] . 'am</td>
                <td>'. $Mtime_out . '</td>
                <td>'. $Atime_in . '</td>
                <td>'. $Atime_out . '</td>
                <td>'. $timeAcquired . '</td>
                <td>'. $result['day_date'] . '</td>
            </tr>';
            }
            echo '</table>';
        } else {
            echo '
            <table>
            <th>Time-in</th>
            <th>Time-out</th>
            <th>Time-in</th>
            <th>Time-out</th>
            <th>Date</th>
            </table>'
            ;
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
