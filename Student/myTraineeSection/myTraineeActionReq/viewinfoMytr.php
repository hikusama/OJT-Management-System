<?php
require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = intval($_POST['spid']);
    $imgSrc = $_POST['imgdp'];

    // Prepare the SQL statement with named placeholders
    $sql = "SELECT * FROM students 
    INNER JOIN users ON students.users_id = users.user_id
    WHERE students.stu_id = :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the search result (assuming there's only one result)
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result1) {
 


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
                    <p id="infoper4">Email<span><?php echo $result1["email"] ?></span></p>
                </div>
            </div>
<?php 

    } else {
        echo "No matching user found.";
    }
}
?>