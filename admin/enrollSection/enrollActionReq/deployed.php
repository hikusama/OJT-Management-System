<?php


require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';


    $sql = "SELECT *
    FROM students
    LEFT JOIN department ON department.department = students.department
    LEFT JOIN trainee ON trainee.stu_id = students.stu_id
    
    WHERE students.stu_id IN (
        SELECT stu_id
        FROM trainee
    ) and trainee.supervisor_info_id is not null";



    if (!empty($searchQuery)) {
        $sql .= ' AND
        (students.firstname LIKE :searchQuery OR students.lastname LIKE :searchQuery)';
    }

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
      background: linear-gradient(271deg, black, red) !important;

    }

    #cont-viewinform::after {
      background: linear-gradient(271deg, black, red);
    }

    #cont-viewinform::before {
      background: linear-gradient(271deg, black, red);
    }

    #students .liEnroll .pfront p {
      color: red !important;
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
            echo "<p>{$result["deptAcronym"]}</p>";
            echo '</div>';

            echo '<div class="grupi">';
?>
            <div class="showact" id="enrl">
                <i class="fa-solid fa-user-slash act2" id="del<?php echo $result["stu_id"] . "n" . $result["users_id"]; ?>"></i>
                <i class="fa-solid fa-person-circle-exclamation act3"></i>
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