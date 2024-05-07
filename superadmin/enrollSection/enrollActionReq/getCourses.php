<?php

require_once '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT DISTINCT course_id FROM students";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $courseIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if ($courseIds) {
        $sql2 = "SELECT * FROM course WHERE course_id IN (".implode(',', array_fill(0, count($courseIds), '?')).")";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute($courseIds);
        $courses = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        if ($courses) {
            
            foreach ($courses as $course) {
                echo '<p>' . $course['course'] . '</p>';
            }
        } else {
            echo 'No courses found for students.';
        }
    } else {
        echo 'No courses found for students.';
    }
}
?>
