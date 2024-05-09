<?php

require_once '../../../includes/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];
    $sql = "SELECT * FROM admins";

    $stmt = $pdo->prepare($sql);
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
                </div>

            </li>
<?php
        }
    } else {
        echo "nahhh you'd lose";
    }
}
