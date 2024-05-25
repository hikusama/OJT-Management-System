<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "GET") {





    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';



    try {
    } catch (\Throwable $th) {
        //throw $th;
    }

    $department1 = $_SESSION['department'];




    // Prepare and execute the database query
    $sql = "SELECT *
    FROM students 
    left join  department on department.department = students.department
    left join  course on course.course = students.course
    where students.department = :department1";


    if (!empty($searchQuery)) {
        $sql .= ' AND firstname LIKE :searchQuery';
 
    }

    $stmt = $pdo->prepare($sql);
    if ($searchQuery != '') {
        $searchParam = "%$searchQuery%";
        $stmt->bindParam(':searchQuery', $searchParam);
    }
    $stmt->bindParam(':department1', $department1);
    $stmt->execute();

    // Fetch the search results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the search results (you can customize this part based on your needs)
    if ($results) {
        foreach ($results as $result) {

            echo '<li class="liEnroll" >';
            echo '<i id="men" class="fa-solid fa-ellipsis "></i>
             <div class="pfront">';
            echo "<img src='data:image/jpeg;base64," . base64_encode($result["profile_pic"]) . "' alt='' srcset='' id='myproffromdb'>";
            echo "<h4>{$result["firstname"]}</h4>";
            echo "<p>{$result["crsAcronym"]}</p>";
            echo '</div>';

            echo '<div class="grupi">

            <div class="showact" id="'. $result["firstname"] . "_" . $result["lastname"] . '">
                <i class="fa-regular fa-pen-to-square act1"></i>
                <i class="fa-solid fa-user-slash act2" id="del' . $result["stu_id"] . "n" . $result["users_id"] . '"></i>
                <i class="fa-solid fa-person-circle-exclamation act3"></i>
 
            </div> 
            </div>
            </li>';
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