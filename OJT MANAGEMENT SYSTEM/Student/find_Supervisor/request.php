<?php

require_once '../../includes/config.php';
require_once '../../includes/session.php';

function create_request(object $pdo){
    $request_status = "Pending";
    $query = "INSERT INTO request (request_status, student_id, supervisor_id) VALUES (:request_status, :student_id, :supervisor_id);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":request_status", $request_status);
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":supervisor_id", $supervisor_id);
    $stmt->execute();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){

    try{
        $request_id = create_request($pdo);
        header("Location: ../find_Supervisor/index.php");
        $pdo=null;
        $stmt=null;
        die();
    }catch(PDOException $e){
        die("Query Failed: " . $e->getMessage());
    }
}else{
    header("Location: ../find_Supervisor/index.php");
    die();
}