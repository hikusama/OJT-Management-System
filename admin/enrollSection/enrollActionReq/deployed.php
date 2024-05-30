<?php


require_once '../../../includes/config.php';

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
  header('location: ../../index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {



  $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

  try {
    $department = $_SESSION['department'];


    $sql = "SELECT *
          FROM students
          LEFT JOIN department ON department.department = students.department
          LEFT JOIN trainee ON trainee.stu_id = students.stu_id    
          left join  course on course.course = students.course

          
          WHERE students.stu_id IN (
              SELECT stu_id
              FROM trainee
          ) 
          and trainee.supervisor_info_id is not null
          and students.department = :department  ";



    if (!empty($searchQuery)) {
      $sql .= ' AND
              (students.firstname LIKE :searchQuery OR students.lastname LIKE :searchQuery)';
    }

    $stmt = $pdo->prepare($sql);

    if (!empty($searchQuery)) {
      $searchParam = "%$searchQuery%";
      $stmt->bindParam(':searchQuery', $searchParam);
    }
    $stmt->bindParam(':department', $department);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
      echo '<style>
              .liEnroll::after {
            background: linear-gradient(271deg, black, red) !important;

          }

          #cont-viewinform::after {
            background: linear-gradient(271deg, black, red);
          }

          #cont-viewinform::before {
            background: linear-gradient(271deg, black, red);
          }

          #students .liEnroll .pfront p {
            color: #ff4141 !important;
          }

          .viewinform #vinfo {
            border: solid .2rem red;
          }
      </style>';
      foreach ($results as $result) {
        echo '<li class="liEnroll">';
        echo '<i id="men" class="fa-solid fa-ellipsis "></i>
                    <div class="pfront">';
        echo "<img src='data:image/jpeg;base64," . base64_encode($result["profile_pic"]) . "' alt='' srcset='' id='myproffromdb'>";
        echo "<h4>{$result["firstname"]}</h4>";
        echo "<p>{$result["crsAcronym"]}</p>";
        echo '</div>';

        echo '<div class="grupi">';

        echo '
              <div class="showact" id="enrl">
                <i class="fa-solid fa-user-slash act2" id="del' .  $result["stu_id"] . "n" . $result["users_id"] . '"></i>
                <i class="fa-solid fa-person-circle-exclamation act3"></i>
              
              </div>
              </div>
              </li>';
      }
    } else {
      echo "<p>No results found.</p>";
    }
  } catch (\Throwable $th) {
    //throw $th;
  }
}
