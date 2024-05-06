<?php


require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {





    $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';

    // Prepare and execute the database query
    $sql = "SELECT * FROM program_catalog WHERE department LIKE :searchQuery OR deptAcronym LIKE :searchQuery OR course LIKE :searchQuery OR crsAcronym LIKE :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['searchQuery' => $searchQuery]);

    // Fetch the search results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the search results (you can customize this part based on your needs)
    if ($results) {
        foreach ($results as $result) {
?>
            <li>
                <div class="overlayProg ">
                    <i class="fa-regular fa-pen-to-square act1"></i>
                    <i class="fa-solid fa-trash act2"></i>
                </div>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($result['program_pic']) ?>" alt="">
                <div class="det">
                    <h4><?php echo $result['crsAcronym']  ?></h4>
                    <p><?php  echo $result['course']  ?></p>
                    <h4><?php echo $result['deptAcronym']  ?></h4>
                    <p><?php echo $result['department']  ?></p>
                    <div class="otherCount">
                        <p>Courses: <span>15</span></p>
                        <p>Student: <span>1500</span></p>
                    </div>
                </div>
            </li>
<?php
        }
    } else {
        echo "No results found.";
    }
} ?>