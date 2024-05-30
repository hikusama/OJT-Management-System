<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = $_SESSION['department'];
    $table = $_POST['table'];
    $sql = "SELECT * FROM $table 
    where department = :department";

    $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':department',$department);
        $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $result) {
            // if ($result['duty_Status'] == 'offDuty') {
            //     $color = 'rgb(236 5 5)';
            // }elseif ($result['duty_Status'] == 'onDuty') {
            //     $color = 'rgb(3 189 36)';
            // }
?>
            <li>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($result['profile_pic']) ?>" id="" alt="">
                <div class="persIn">
                    <h4><?php echo $result['firstname'] . ' ' . $result['lastname'] ?></h4>
                    <!-- <p style="color:<?php //echo $color ?> ;"><?php //echo $result['duty_Status'] ?></p> -->
                </div>

            </li>
<?php
        }
    } else {
        echo "nahhh you'd lose";
    }
}
