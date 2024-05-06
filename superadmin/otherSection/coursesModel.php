<?php


declare(strict_types=1);


function getcourse(object $pdo, string $course)
{
    $sql = "SELECT * FROM program_catalog WHERE course = :course";
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
function getdpt(object $pdo, string $dpt)
{
    $sql = "SELECT * FROM program_catalog WHERE department = :dpt";
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
    $sql = "SELECT * FROM program_catalog WHERE crsAcronym = :crsacrm";
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
    $sql = "SELECT * FROM program_catalog WHERE deptAcronym = :dptacrm";
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

function addCourse(object $pdo, string $course, string $ImageData,string $dpt,string $crsacrm,string $deptacrm )
{
    $sql = "INSERT INTO program_catalog(course,program_pic,department,deptAcronym,crsAcronym) 
    VALUES(:course,:ImageData,:dpt,:crsacrm,:deptacrm)";
    $stmt = $pdo->prepare($sql);
    $stmt -> bindParam(':course',$course);
    $stmt -> bindParam(':ImageData',$ImageData,PDO::PARAM_LOB);
    $stmt -> bindParam(':dpt',$dpt);
    $stmt -> bindParam(':crsacrm',$crsacrm);
    $stmt -> bindParam(':deptacrm',$deptacrm);
    $stmt->execute();

}
