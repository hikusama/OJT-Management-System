
<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../index.php');
}
require_once '../../includes/config.php';
require_once 'programModel.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supVId = getSupId($pdo, intval($_SESSION["user_id"]));

    $report_id = intval(trim($_POST['repid']));
    $Rstatus = trim($_POST['status']);

    $valid_stat = ['Approved','Rejected'];
 
    if (isPendingStat($pdo) && in_array($Rstatus,$valid_stat)) {
        $sql = "UPDATE reports
    set report_status = :Rstatus
    where report_id = :report_id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':Rstatus', $Rstatus);
        $stmt->bindParam(':report_id', $report_id);
        $stmt->execute();
        echo 'success';
        exit();
    }


}