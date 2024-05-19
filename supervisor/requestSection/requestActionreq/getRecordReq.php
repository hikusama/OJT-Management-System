<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id =  intval($_SESSION['user_id']);

    require_once '../reqModel.php';

    $superVid = getSupId($pdo, $user_id);
    $sql = "SELECT students.firstname,department.deptAcronym,course.crsAcronym,request.request_status,request.request_at,request.respond_at
    FROM students 
        INNER JOIN  request on students.stu_id = request.stu_id 
        LEFT JOIN  department on department.department = students.department 
        LEFT JOIN  course on course.course = students.course 
        
        WHERE request.request_status != 'Pending' 
        AND request.supervisor_id = :superVid
        AND request.requested_to = 'Supervisor'
        ORDER BY request.request_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':superVid', $superVid, PDO::PARAM_INT);
    $stmt->execute();

    $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result1) {

        echo '<table>
    <tr>
        <th>Firstname</th>
        <th>Department</th>
        <th>Course</th>
        <th>Status</th>
        <th>Respond</th>
        <th>Request</th>
    </tr>';
        foreach ($result1 as $result) {
            $stat = $result['request_status'];
            $colorStat;
            if ($stat == 'Accepted') {
                $colorStat = '#0dae00';
            } elseif ($stat == 'Rejected') {
                $colorStat = '#e60000';
            }else{
                $colorStat = 'white';
            }
?>
            <tr>
                <td><?php echo $result['firstname'] ?></td>
                <td><?php echo $result['deptAcronym'] ?></td>
                <td><?php echo $result['crsAcronym'] ?></td>
                <td style="color: <?php echo $colorStat ?>"><?php echo $result['request_status'] ?></td>
                <td><?php echo $result['respond_at'] ?></td>
                <td><?php echo $result['request_at'] ?></td>
            </tr>
<?php
        }
        echo '</table>';
    } else {
        echo '<table>
        <tr>
            <th>Firstname</th>
            <th>Department</th>
            <th>Course</th>
            <th>Status</th>
            <th>Respond</th>
            <th>Request</th>
        </tr>
        </table>';
        echo "<p style='margin-top:2rem'>No records yet.</p>";
    }
}
?>