<?php


declare(strict_types=1);


function getcourse(object $pdo, string $course)
{
    $sql = "SELECT * FROM course WHERE course = :course";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':course', $course);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return null;
    }
}
function getdptId(object $pdo, int $dept_id)
{
    $sql = "SELECT * FROM department WHERE program_id = :dept_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':dept_id', $dept_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return null;
    }
}

function getdpt(object $pdo, string $dpt)
{
    $sql = "SELECT * FROM department WHERE department = :dpt";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':dpt', $dpt);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return null;
    }
}

function getcrsacrm(object $pdo, string $crsacrm)
{
    $sql = "SELECT * FROM course WHERE crsAcronym = :crsacrm";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':crsacrm', $crsacrm);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return null;
    }
}

function getdptacrm(object $pdo, string $dptacrm)
{
    $sql = "SELECT * FROM department WHERE deptAcronym = :dptacrm";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':dptacrm', $dptacrm);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return null;
    }
}

function addCourse(object $pdo, int $dept_id, string $course, string $crsacrm)
{
    $sql = "INSERT INTO course(dept_id,course,crsAcronym) 
    VALUES(:dept_id, :course, :crsacrm)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':dept_id', $dept_id);
    $stmt->bindParam(':course', $course);
    $stmt->bindParam(':crsacrm', $crsacrm);
    $stmt->execute();
}
function addDept(object $pdo, string $ImageData, string $dpt, string $deptacrm)
{
    $sql = "INSERT INTO department(program_pic,department,deptAcronym) 
    VALUES(:ImageData,:dpt,:deptacrm)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ImageData', $ImageData, PDO::PARAM_LOB);
    $stmt->bindParam(':dpt', $dpt);
    $stmt->bindParam(':deptacrm', $deptacrm);
    $stmt->execute();
}
