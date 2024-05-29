<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}


require_once '../../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once '../homeModel.php';

    $studId = getStudId($pdo, intval($_SESSION["user_id"]));

    $sql = "SELECT s.profile_pic,s.firstname FROM trainee as t
    INNER JOIN students as s on s.stu_id = t.stu_id
    
    WHERE t.stu_id = :studId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    date_default_timezone_set('Asia/Manila');
    // $current_time = date('H:i');
    $current_time = time_controll();

    $lunch_time = '12:00';
    $entry_time = '08:00';
    $afternoon_time = '13:00';
    $dismiss_time = '17:00';


    try {

        if (checkAttendance($pdo, $studId)) {
            if (!(waiting_for_aft($pdo, $studId) && $current_time <= $lunch_time)) {
                if (!(waiting_nxt_morn($pdo, $studId) && $current_time >= $afternoon_time  && $current_time < $dismiss_time)) {

                    if (!($current_time >= $lunch_time && $current_time < $afternoon_time)) {


                        if (!($current_time > $dismiss_time)) {


                            echo '
            <div class="outlosdrmqrm">
            <div class="innerloadsd">
                <div class="loader">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="fDp">
            <img src="data:image/jpeg;base64,' . base64_encode($result['profile_pic']) . '" alt="">
            <h2>' . $result['firstname'] . '</h2>
            </div>
            <div class="attendanceButton">
            ';
                            if (!isAlready_Timein($pdo, $studId)) {
                                echo '<button id="timein">Time-in</button>';
                            } else {
                                echo '<button id="" style="opacity:50%;cursor:not-allowed;" >Time is running</button>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p class="resClose">Have a <span>"GREAT NIGHT.."</span></p>';
                        }
                    } else {
                        echo '<p class="resClose"><span>"LUNCH"</span> time!.</p>';
                    }
                } else {

                    echo '<p class="notOpenAtt">Wait for the next Morning!!</p>';
                }
            } else {
                echo '<p class="notOpenAtt">Wait for the next Afternoon!!</p>';
            }
        } else {
            echo '
    <div class="outlosdrmqrm">
    <div class="innerloadsd">
        <div class="loader">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </div>
</div>
    <p class="notOpenAtt">Attendance Closed!!</p>
    
    ';
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
