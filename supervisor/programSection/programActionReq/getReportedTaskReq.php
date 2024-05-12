<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
  header('location: ../../../index.php');
}
require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $user_id =  intval($_SESSION['user_id']);

  require_once '../myTrModel.php';

  $superVid = getSupId($pdo, $user_id);


  $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';


  $sql = "SELECT *
  FROM trainee
  RIGHT JOIN tasks ON tasks.trainee_id = .trainee.trainee_id
  RIGHT JOIN tasks_photos ON tasks_photos.trainee_id = .trainee.trainee_id

  WHERE trainee.supervisor_info_id = :superVid ";

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
//     echo '<style>
//         .liEnroll::after {
//       background: linear-gradient(145deg, red, black)   ;

//     }

//     #cont-viewinform::after {
//       background: linear-gradient(145deg, red, black)  ;
//     }

//     #cont-viewinform::before {
//       background: linear-gradient(145deg, red, black)  ;
//     }

//     #students .liEnroll .pfront p {
//       color: maroon !important;
//     }

//     .viewinform #vinfo {
//       border: solid .2rem maroon;
//     }
// </style>';
    foreach ($results as $result) {
      echo '<li class="liEnroll" >';
      echo '<i id="men" class="fa-solid fa-ellipsis "></i>
             <div class="pfront">';
      echo "<img src='data:image/jpeg;base64," . base64_encode($result["profile_pic"]) . "' alt='' srcset='' id='myproffromdb'>";
      echo "<h4>{$result["firstname"]}</h4>";
      echo "<p id='deptacrm'>{$result["deptAcronym"]}</p>";
      echo '</div>';

      echo '<div class="grupi">';
?>

      <div class="showact" id="enrl">
        
      <i class="fa-solid fa-user-slash act2" id="" title="Drop Trainee"></i>
        <i class="fa-solid fa-person-circle-exclamation act3" title="View  Personal Info." id="del<?php echo $result["stu_id"]  ?>"></i>
      <?php
      echo '</div>';
      echo '</div>';

      echo '</li>';
    }
      ?>

  <?php


  } else {
    echo "<p>No results found.</p>";
  }
} ?>