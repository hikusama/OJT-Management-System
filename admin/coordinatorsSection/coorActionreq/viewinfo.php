<?php
require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = intval($_POST['spid']);
    $imgSrc = $_POST['imgdp'];

    // Prepare the SQL statement with named placeholders
    $sql = "SELECT * FROM supervisors WHERE supervisor_info_id = :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the search result (assuming there's only one result)
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result1) {
        $userids = $result1['users_id'];

        // Prepare the second SQL statement with named placeholders
        $sql2 = "SELECT * FROM users INNER JOIN supervisors ON user_id = :userids";
        
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
            <h2><?php echo $result1["lastname"]  . ", " . $result1["firstname"] . " " . $result1["middlename"]; ?></h2>
            <div class="inforsonal">
                <p id="infoper1">Position<span><?php echo $result1["position"] ?></span></p>
                <p id="infoper2">Department<span><?php echo $result1["department"] ?></span></p>
                <p id="infoper3">Room<span><?php echo $result1["room"] ?></span></p>
                <p id="infoper4">Email<span><?php echo $resultF["email"] ?></span></p>
                <p id="infoper5">Trainee<span>0</span></p>
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
