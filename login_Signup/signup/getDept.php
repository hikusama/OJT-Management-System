<?php


require_once '../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {





    $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';
    $searchQuery = trim($searchQuery);
    // Prepare and execute the database query
    $sql = "SELECT * FROM department WHERE department LIKE :searchQuery or deptAcronym like :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['searchQuery' => $searchQuery]);

    // Fetch the search results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the search results (you can customize this part based on your needs)
    if ($results) {
        foreach ($results as $result) {

?>

            <p id="pr<?php echo $result['program_id'] ?>"><?php echo $result['department'] ?></p>
<?php

        }
    } else {
        echo "No results found.";
    }
} ?>