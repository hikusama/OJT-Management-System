<?php


require_once '../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {




    $searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';

    $sql = "SELECT * FROM department where department = :searchQuery ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
    $stmt->execute();
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result1) {
        $deptId = $result1['program_id'];
        $sql2 = "SELECT * FROM course where dept_id = :deptId ";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':deptId', $deptId);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        if ($result2) {
            foreach ($result2 as $result) {
?>
                <p><?php echo $result['course'] ?></p>
<?php
            }
        } else {
            echo 'No courses in this Dept.';
        }
    }else{
        echo 'No courses in this Dept.';

    }
} ?>