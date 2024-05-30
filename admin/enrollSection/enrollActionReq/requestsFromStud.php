<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../../includes/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $department = $_SESSION['department'];


    try {

        $sql = 'SELECT s.profile_pic,s.firstname,s.lastname,c.crsAcronym,s.stu_id  
        from students as s
        inner JOIN request as rq on s.stu_id = rq.stu_id
        inner JOIN course as c ON s.course = c.course  
        left JOIN trainee as tr ON s.stu_id = tr.stu_id
        
        WHERE tr.stu_id IS NULL 
        and rq.requested_to = "Management" 
        and rq.request_status = "Pending"
        and s.department = :department';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':department',$department);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            foreach ($results as $result) {
                echo '
                    <li>
                    <div class="ovCrs">
                    <i id="add_course_ByOne"  class="fa-solid fa-square-plus " title="Enroll This Student" ></i>
                </div>
                        <div class="picEnrollee">
                            <img id="enrolProfPic" src="data:image/jpeg;base64,' . base64_encode($result["profile_pic"]) . '">
                        </div>
                        <div class="infoNotEnroll">
                            <h5 id="sp' . $result['stu_id'] . '">' . $result["lastname"] . ', '  . $result["firstname"] . '</h5>
                            <p>' . $result['crsAcronym'] . '</p>
                        </div>
                    </li>
                ';
            }
        } else {
            echo 'No requests from student...';
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
