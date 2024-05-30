<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';
require_once '../programModel.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supVId = getSupId($pdo, intval($_SESSION["user_id"]));


    $sql = "SELECT 
    s.firstname,
    s.lastname,
    s.profile_pic,
    rp.title,
    rp.report_id,
    rp.time_acquired,
    rp.report_status,
    rp.day_date
     FROM trainee as tr
    inner join reports as rp on tr.trainee_id = rp.trainee_id
    inner join students as s on tr.stu_id = s.stu_id

  where tr.supervisor_info_id = :supVId
  and day_date = CURRENT_DATE
  ORDER BY report_id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':supVId', $supVId);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

 
    if ($results) {
        foreach ($results as $result) {
            $color_status = 'white';
            if ($result['report_status'] == 'Pending') {
                $color_status = '#bc7900';
            } else if ($result['report_status']== 'Rejected') {
                $color_status = '#ff4747';
            } else if ($result['report_status']== 'Approved') {
                $color_status = '#00bc7b';
            } else {
                $color_status = 'white';
            }


            echo '
            <li>
            
            <div class="firstInfo">
            <img src="data:image/jpeg;base64,' . base64_encode($result['profile_pic']) . '" alt="" id="">
                <h3>' . $result['lastname'] .', '.$result['firstname'] .'</h3>
                <p>' . $result['day_date'] . '</p>
            </div>
            <div class="secondInfo">
                <h4>' . $result['title'] . '</h4>
                <p>Time acquired: ' . $result['time_acquired'] . 'hrs</p>
                <button id="vrep" class="' . $result['report_id'] . '">view report</button>
            </div>
            <p class="dttt" style="color:'. $color_status .'">' . $result['report_status'] . '</p>

        </li>
            
            
            ';
        }
    } else {
        echo 'No report request today.';
    } 
}
