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
}
