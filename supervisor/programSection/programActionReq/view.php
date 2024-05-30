<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';
require_once '../programModel.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supVId = getSupId($pdo, intval($_SESSION["user_id"]));

    $report_id = intval($_POST['repid']);



    $sql = "SELECT * FROM reports
    inner join trainee on trainee.trainee_id = reports.trainee_id
  where trainee.supervisor_info_id = :supVId
  and report_id = :report_id
  ORDER BY report_id DESC";



    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':supVId', $supVId);
    $stmt->bindParam(':report_id', $report_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $actionthings = '<div class="actRepBut">
    <button id="bc">Back</button>
</div>';
    if ($result['report_status'] == 'Pending') {
        $actionthings = '
        <div class="actRepBut">
        <button id="ap">Approve</button>
        <button id="rj">Reject</button> 
        <button id="bc">Back</button>
    </div>';
    } else {
        $actionthings = '
        <div class="actRepBut">
        <button id="bc">Back</button>
    </div>';
    }
 
    

    echo '<div class="outlosdrmqrm">
<div class="innerloadsd">
    <div class="loader">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</div>
</div>';

    if ($result) {

        echo '
            <div class="dttt">' . $result['day_date'] . '</div>
            <div class="imageSec">
                <img src="data:image/jpeg;base64,' . base64_encode($result['pic_proof']) . '" alt="" id="proof_pic">
                <div class="lildesc">
                    <p>Title: <span>' . $result['title'] . '</span></p>
                    <p>Place: <span>' . $result['place'] . '</span></p>
                    <p>Time acquired: <span>' . $result['time_acquired'] . 'hrs</span></p>
                </div>
            </div>
            <div class="vrepInfo">
                <h4>Narrative:</h4>
                <div id="narrated_dp">' . $result['narrative'] . '</div>
            </div>'. $actionthings .'
            
            ';
    } else {
        echo 'No result found.';
    }
}
