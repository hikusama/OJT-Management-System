<?php


require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';


    $sql = "SELECT *
    FROM students
    LEFT JOIN department ON department.department = students.department
    WHERE students.stu_id IN (
        SELECT stu_id
        FROM trainee
    )";



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