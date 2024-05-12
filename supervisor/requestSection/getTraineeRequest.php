<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../index.php');
}
require_once '../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $user_id =  intval($_SESSION['user_id']);
    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

    require_once 'reqModel.php';

    $superVid = getSupId($pdo, $user_id);

    $sql = "SELECT DISTINCT students.firstname, students.stu_id, students.profile_pic, students.department, request.request_id
    FROM request
    INNER JOIN supervisors ON supervisors.supervisor_info_id = request.supervisor_id
    LEFT JOIN trainee ON request.supervisor_id = trainee.supervisor_info_id
    LEFT JOIN students ON request.stu_id = students.stu_id
    WHERE students.stu_id IN (
        SELECT stu_id
        FROM trainee
    ) AND supervisors.supervisor_info_id = :superVid AND request.request_status = 'Pending' and request.requested_by = 'Student' ;
    ";

    if (!empty($searchQuery)) {
        $sql .= ' AND
        (students.firstname LIKE :searchQuery OR students.lastname LIKE :searchQuery)';
    }

    $stmt = $pdo->prepare($sql);

    if (!empty($searchQuery)) {
        $searchParam = "%$searchQuery%";
        $stmt->bindParam(':searchQuery', $searchParam);
    }
    $stmt->bindParam(':superVid', $superVid);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
 

            foreach ($results as $result) {
                $deptAcr = getDeptAcr($pdo, $result['department']);

?>
                <li>
                    <div class="innerCount">
                        <div class="profCred" id="prd<?php echo $result['stu_id'] . "n" . $result["request_id"];?>">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($result['profile_pic']) ?>" id="pic-req" alt="">
                            <h3><?php echo $result['firstname'] ?></h3>
                            <p><?php echo $deptAcr ?></p>
                        </div>
                        <div class="action-to-req">
                            <button id="admit">Admit</button>
                            <button id="reject">Reject</button>
                            <button id="view">View</button>
                        </div>
                    </div>
                </li>
<?php
            }

    } else {
        echo "<p>No request yet.</p>";
    }
} ?>