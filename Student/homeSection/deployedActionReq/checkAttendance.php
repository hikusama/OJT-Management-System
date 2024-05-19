<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}


require_once '../../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once '../homeModel.php';

    $studId = getStudId($pdo,intval($_SESSION["user_id"]));

    $sql = "SELECT s.profile_pic,s.firstname FROM trainee as t
    INNER JOIN students as s on s.stu_id = t.stu_id
    
    WHERE t.stu_id = :studId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studId', $studId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);



    try {
        
        if(checkAttendance($pdo,$studId)){
            echo'
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
            <img src="data:image/jpeg;base64,'. base64_encode($result['profile_pic']) .'" alt="">
            <h2>'. $result['firstname'] .'</h2>
            <div class="timestamp">00:00:00</div>
            ';
        }else{
            echo'
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

    }  catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }




}

