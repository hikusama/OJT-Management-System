<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
  header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id =  intval($_SESSION['user_id']);

  require_once '../myTrModel.php';

  $superVid = getSupId($pdo, $user_id);

  date_default_timezone_set('Asia/Manila');
  // $current_time = date('H:i');
  $current_time = time_controll();

  $lunch_time = '12:00';
  $entry_time = '08:00';
  $afternoon_time = '13:00';
  $dismiss_time = '17:00';



  $access = 'Close';
  $pusa = 'ngiao';
  $action = 'fa-user-plus';

  if (isset($_POST['forClosing'])) {
    $access = 'Open';
    $pusa = 'ngiao2';
    $action = 'fa-user-minus';
  } else {
    $access = 'Close';
    $pusa = 'ngiao';
    $action = 'fa-user-plus';
  }
  $sql = "SELECT *
  FROM students
  LEFT JOIN department ON department.department = students.department
  LEFT JOIN trainee ON trainee.stu_id = students.stu_id
  WHERE trainee.supervisor_info_id = :superVid 
  and trainee.attendance_access = :access";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':superVid', $superVid);
  $stmt->bindParam(':access', $access);
  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (!($current_time > $dismiss_time)) {
    if ($results) {

      foreach ($results as $result) {
        echo '<li>
            <div class="imgInAtt">
              <img src="data:image/jpeg;base64,' . base64_encode($result['profile_pic']) . '"  alt="">
            </div>
            <div class="myTrInAtt">
              <h4 id="name">' . $result['lastname'] . ', ' . $result['firstname'] . ' </h4>
            </div>
            <div><i class="fas ' . $action . ' ' . $pusa . '" id="def' . $result['trainee_id'] . '"></i></div>
          </li>';
      }
    } else {
      echo "<p>No trainees found.</p>";
    }
  } else {
    executeCloseAttendaceToAll($pdo, $superVid);
    echo '<p class="resClose">Have a <span>"GREAT NIGHT.."</span></p>';
  }
}
