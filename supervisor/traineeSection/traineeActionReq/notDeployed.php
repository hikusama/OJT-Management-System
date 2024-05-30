<?php


require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET") {


  $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';


  $sql = "SELECT *
    FROM students
    LEFT JOIN department ON department.department = students.department
    LEFT JOIN request ON request.stu_id = students.stu_id
    LEFT JOIN trainee ON trainee.stu_id = students.stu_id
    
    WHERE students.stu_id IN (
        SELECT stu_id
        FROM trainee
    ) 
    and trainee.supervisor_info_id is null ";

  if (!empty($searchQuery)) {
    $sql .= ' AND
        (students.firstname LIKE :searchQuery OR students.lastname LIKE :searchQuery)';
  }
  $sql .= " GROUP BY students.stu_id";
  $stmt = $pdo->prepare($sql);

  if (!empty($searchQuery)) {
    $searchParam = "%$searchQuery%";
    $stmt->bindParam(':searchQuery', $searchParam);
  }

  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($results) {
    echo '<style>

    
    .liEnroll::after {
      background: linear-gradient(271deg, black, rgb(255 187 0)) !important ;
    }

    #cont-viewinform::after {
      background: linear-gradient(271deg, black, rgb(255 187 0)) !important;
    }

    #cont-viewinform::before {
      background: linear-gradient(271deg, black, rgb(255 187 0)) !important;
    }

    #trainee .liEnroll .pfront p {
      color: rgba(255, 187, 0, 0.678) !important;
    }

    .viewinform #vinfo {
      border: solid .2rem rgba(255, 187, 0, 0.678);
    }
</style>';
    foreach ($results as $result) {
      echo '<li class="liEnroll" >';
      echo '<i id="men" class="fa-solid fa-ellipsis "></i>
             <div class="pfront">';
      echo "<img src='data:image/jpeg;base64," . base64_encode($result["profile_pic"]) . "' alt='' srcset='' id='myproffromdb'>";
      echo "<h4>{$result["firstname"]}</h4>";
      echo "<p>{$result["deptAcronym"]}</p>";
      echo '</div>';

      echo '<div class="grupi">';
?>

      <div class="showact" id="enrl">
        <i class="fas fa-flag act1" title="Request"></i>
        <i class="fa-solid fa-person-circle-exclamation act3" title="View Personal Info." id="del<?php echo $result["stu_id"]  ?>"></i>
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