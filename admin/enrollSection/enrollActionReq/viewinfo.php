<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = intval($_POST['spid']);
    $imgSrc = $_POST['imgdp'];
    $department = $_SESSION['department'];

    // Prepare the SQL statement with named placeholders
    $sql = "SELECT * FROM students WHERE stu_id = :searchQuery
    and department = :department";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_INT);
    $stmt->bindParam(':department', $department);
    $stmt->execute();

    // Fetch the search result (assuming there's only one result)
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result1) {
        $userids = $result1['users_id'];

        // Prepare the second SQL statement with named placeholders
        $sql2 = "SELECT * FROM users INNER JOIN students ON user_id = :userids";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':userids', $userids, PDO::PARAM_INT);
        $stmt2->execute();

        $resultF = $stmt2->fetch(PDO::FETCH_ASSOC);
        if ($resultF) {


    ?>

            <div class="outlosdviewinfo">
                <div class="innerloadsd">
                    <div class="loader">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>
            </div>
            <div class="viewinform">
                <img src="<?php echo $imgSrc ?>" id="vinfo" alt="">
                <h2><?php echo $result1["lastname"] . ", " . $result1["firstname"] . " " . $result1['middlename'] ;?></h2>
                <div class="inforsonal">
                    <p id="infoper.02">Gender<span><?php echo $result1["gender"] ?></span></p>
                    <p id="infoper.01">Student No<span><?php echo $result1["student_id"] ?></span></p>
                    <p id="infoper.01">Course<span><?php echo $result1["course"] ?></span></p>
                    <p id="infoper.02">Year level<span><?php echo $result1["year_levelnsection"] ?></span></p>
                    <p id="infoper2">Department<span><?php echo $result1["department"] ?></span></p>
                    <p id="infoper.02">Contact<span><?php echo $result1["contact"] ?></span></p>
                    <p id="infoper.02">Address<span><?php echo $result1["address"] ?></span></p>
                    <p id="infoper4">Email<span><?php echo $resultF["email"] ?></span></p>
                </div>
            </div>
<?php 
        } else {
            echo "No matching user found.";
        }
    } else {
        echo "No matching admin found.";
    }
}
?>
