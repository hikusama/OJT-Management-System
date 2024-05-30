<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = $_SESSION['department'];
    $table = $_POST['table'];
    $sql = "SELECT * FROM trainee 
            RIGHT JOIN students ON students.stu_id = trainee.stu_id
            WHERE trainee.stu_id IS NOT NULL 
            and department = :department";

            
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':department',$department);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $result) {
?>
            <li>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($result['profile_pic']) ?>" id="" alt="">
                <div class="persIn">
                    <h4><?php echo $result['firstname'] . ' ' . $result['lastname'] ?></h4>
                </div>
            </li>
<?php
        }
    } else {
        echo "No trainees yet";
    }
}
?>
