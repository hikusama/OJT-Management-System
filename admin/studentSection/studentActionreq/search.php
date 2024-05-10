<?php


require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET") {





    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

    // Prepare and execute the database query
    $sql = "SELECT *
    FROM students
    WHERE stu_id NOT IN (
        SELECT stu_id
        FROM trainee
    )";

    if (!empty($searchQuery)) {
        $sql .= ' AND (firstname LIKE :searchQuery)';
    }

    $stmt = $pdo->prepare($sql);
    if (!empty($searchQuery)) {
        $searchParam = "%$searchQuery%";
        $stmt->bindParam(':searchQuery', $searchParam);
    }

    $stmt->execute();

    // Fetch the search results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the search results (you can customize this part based on your needs)
    if ($results) {
        foreach ($results as $result) {
            $department = $result['department'];
            $sql3 = "SELECT * FROM department where department = :department";
            $stmt3 = $pdo->prepare($sql3);
            $stmt3->bindParam(':department', $department);
            $stmt3->execute();

            $resultDept = $stmt3->fetch(PDO::FETCH_ASSOC);
            echo '<li class="liEnroll" >';
            echo '<i id="men" class="fa-solid fa-ellipsis "></i>
             <div class="pfront">';
            echo "<img src='data:image/jpeg;base64," . base64_encode($result["profile_pic"]) . "' alt='' srcset='' id='myproffromdb'>";
            echo "<h4>{$result["firstname"]}</h4>";
            echo "<p>{$resultDept["deptAcronym"]}</p>";
            echo '</div>';

            echo '<div class="grupi">';
?>
            <div class="showact" id="<?php echo $result["firstname"] . "_" . $result["lastname"]; ?>">
                <i class="fa-regular fa-pen-to-square act1"></i>
                <i class="fa-solid fa-user-slash act2" id="del<?php echo $result["stu_id"] . "n" . $result["users_id"]; ?>"></i>
                <i class="fa-solid fa-person-circle-exclamation act3"></i>
            <?php
            echo '</div>';
            echo '</div>';

            echo '</li>';
        }
        // 38
        // 40
        // 42
        // 43
        // 44
        // 45
        // 46


            ?>

    <?php


    } else {
        echo "<p>No results found.</p>"; // Display a message if no results are found
    }
} ?>