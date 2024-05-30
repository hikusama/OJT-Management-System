<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';
require_once '../programModel.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["accesstype"] != 'notTrainee') {

        $studId = getStudId($pdo, intval($_SESSION["user_id"]));
        $trainee_id = getTraineeId($pdo, $studId);


        $sql = "SELECT * FROM reports
  where trainee_id = :trainee_id
  ORDER BY report_id DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':trainee_id', $trainee_id);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '

    <li>
    <i class="fas fa-plus" id="showReportForm"></i>
</li>
    ';
        if ($results) {
            foreach ($results as $result) {
                $color_status = 'white';
                if ($result['report_status'] == 'Pending') {
                    $color_status = '#bc7900';
                } else if ($result['report_status'] == 'Rejected') {
                    $color_status = '#bc0000';
                } else if ($result['report_status'] == 'Approved') {
                    $color_status = '#00bc7b';
                } else {
                    $color_status = 'white';
                }


                echo '
            <li>
            <div class="firstInfo">
            <h2 style="color:' . $color_status . ';font-size: 1.2rem;">' . $result['report_status'] . '</h2>
            </div>
            <div class="secondInfo">
                <h4>' . $result['title'] . '</h4>
                <p>Time acquired: ' . $result['time_acquired'] . 'hrs</p>
                <button id="vrep" class="' . $result['report_id'] . '">view report</button>
            </div>
            <p class="dttt">' . $result['day_date'] . '</p>
        </li>
            
            
            ';
            }
        } else {
            echo 'No submitted report.';
        }
    }else{
        echo 'You are not a trainee';
    }
}
