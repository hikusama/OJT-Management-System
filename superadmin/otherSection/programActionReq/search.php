<?php
require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';

    $sql = "SELECT * FROM department WHERE department LIKE :searchQuery OR deptAcronym LIKE :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['searchQuery' => $searchQuery]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $result) {
            $frDptId = $result["program_id"];

            // Count total courses
            $sqlTotalCourses = "SELECT COUNT(*) AS total_rows FROM course WHERE dept_id = :frDptId";
            $stmtTotalCourses = $pdo->prepare($sqlTotalCourses);
            $stmtTotalCourses->bindParam(':frDptId', $frDptId);
            $stmtTotalCourses->execute();
            $resultTotalCourses = $stmtTotalCourses->fetch(PDO::FETCH_ASSOC);
            $totalRows = $resultTotalCourses['total_rows'];

            // Get specific course
            $sqlGetCourse = "SELECT course FROM course WHERE dept_id = :frDptId";
            $stmtGetCourse = $pdo->prepare($sqlGetCourse);
            $stmtGetCourse->bindParam(':frDptId', $frDptId);
            $stmtGetCourse->execute();
            $getCourse = $stmtGetCourse->fetchColumn(); // Assuming only one course per department

            // Count students for specific course
            $sqlTotalStudents = "SELECT COUNT(*) AS totalofstudents FROM students WHERE course = :getCourse";
            $stmtTotalStudents = $pdo->prepare($sqlTotalStudents);
            $stmtTotalStudents->bindParam(':getCourse', $getCourse);
            $stmtTotalStudents->execute();
            $resultTotalStudents = $stmtTotalStudents->fetch(PDO::FETCH_ASSOC);
            $totalofstudents = $resultTotalStudents['totalofstudents'];

            // Output results
            ?>
            <li>
                <div class="overlayProg ">
                    <i class="fa-regular fa-pen-to-square act1"></i>
                    <i class="fa-solid fa-trash act2"></i>
                </div>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($result['program_pic']) ?>" alt="">
                <div class="det">
                    <h4><?php echo $result['deptAcronym'] ?></h4>
                    <p><?php echo $result['department'] ?></p>
                    <div class="otherCount">
                        <p>Courses: <span><?php echo $totalRows ?></span></p>
                        <p>Student: <span><?php echo $totalofstudents ?></span></p>
                    </div>
                </div>
            </li>
            <?php
        }
    } else {
        echo "No results found.";
    }
}
?>
