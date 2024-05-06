<?php


require_once '../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {




    $searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';

    // Prepare and execute the database query
    $sql = "SELECT * FROM department RIGHT JOIN course ON dept_id = :searchQuery ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':searchQuery', $userids, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the search results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the search results (you can customize this part based on your needs)
    if ($results) {
        echo '<option value="">Course</option>';
        foreach ($results as $result) {
?>

            <option value="<?php echo $result['course'] ?>"><?php echo $result['course'] ?></option>
<?php
        }
    } else {

    }
} ?>