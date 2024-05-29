<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';
require_once '../programModel.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studId = getStudId($pdo, intval($_SESSION["user_id"]));
    $trainee_id = getTraineeId($pdo, $studId);

    $report_id = intval($_POST['repid']);

    $sql = "SELECT * FROM reports
  where trainee_id = :trainee_id
  and report_id = :report_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':trainee_id', $trainee_id);
    $stmt->bindParam(':report_id', $report_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);



    if ($result) {
 
            echo '
            <div class="dttt">' . $result['day_date'] . '</div>
            <div class="imageSec">
                <img src="data:image/jpeg;base64,' . base64_encode($result['pic_proof']) . '" alt="" id="proof_pic">
                <div class="lildesc">
                    <p>Title: <span>' . $result['title'] . '</span></p>
                    <p>Place: <span>' . $result['place'] . '</span></p>
                    <p>Time acquired: <span>' . $result['time_acquired'] . 'rs</span></p>
                </div>
            </div>
            <div class="vrepInfo">
                <h4>Narrative:</h4>
                <div id="narrated_dp">' . $result['narrative'] . '</div>
            </div>
            <div class="actRepBut">
                <!-- <button id="ap">Approve</button>
                <button id="rj">Reject</button> -->
                <button id="bc">Back</button>
            </div>
            
            ';
    } else {
        echo 'No rejected report.';
    }
}
