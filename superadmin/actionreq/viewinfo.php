<?php
require_once '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = filter_input(INPUT_POST, 'spid', FILTER_SANITIZE_NUMBER_INT);
    $imgSrc = $_POST['imgdp'];
    // formData.append('imgdp', imgSrc);
    // formData.append('spid', suprevId);

    // Prepare the SQL statement with named placeholders
    $sql = "SELECT * FROM supervisors WHERE supervisor_info_id = :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['searchQuery' => $searchQuery]);

    // Fetch the search result (assuming there's only one result)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
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
            <h2><?php echo $result["lastname"]  . ", " . $result["middlename"] . " " . $result["firstname"]; ?></h2>
            <div class="inforsonal">
                <p id="infoper1">Position<span><?php echo $result["position"] ?></span></p>
                <p id="infoper2">Department<span><?php echo $result["department"] ?></span></p>
                <p id="infoper3">Room<span><?php echo $result["room"] ?></span></p>
                <p id="infoper4">Email<span><?php echo $result["email"] ?></span></p>
                <p id="infoper5">Trainee<span>0</span></p>
            </div>
        </div>
<?php
    } else {
        echo "nahh youd loose";
    }
}
?>