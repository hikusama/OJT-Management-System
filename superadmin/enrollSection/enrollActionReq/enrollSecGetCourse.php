<?php

require_once '../../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

    try {

        $sql = 'SELECT 
        course.*,
        trainee.*,
        COUNT(students.student_id) AS total_students
    FROM 
        course
    INNER JOIN 
        students ON students.course = course.course
    LEFT JOIN
        trainee ON trainee.stu_id = students.stu_id';

        if (!empty($searchQuery)) {
            $sql .= ' AND (course.course LIKE :searchQuery 
                        OR course.crsAcronym LIKE :searchQuery)';
        }

        $sql .= ' LIMIT 0, 25;';

        $stmt = $pdo->prepare($sql);

        if (!empty($searchQuery)) {
            $searchParam = "%$searchQuery%";
            $stmt->bindParam(':searchQuery', $searchParam);
        }

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {

            foreach ($results as $result) {
                $toDeptId = $result['dept_id'];
                $sql2 = 'SELECT
                            department.program_pic
                        FROM
                            department
                        WHERE department.program_id = :toDeptId';
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam(':toDeptId', $toDeptId);
                $stmt2->execute();

                $resultforp = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
                <div class="loadli">
                    <div class="inner-loadli">
                        <ol>
                            <span class="pictemplate"></span>
                            <span class="infotemplate"><span class="Displayname"></span></span>
                        </ol>
                        <ol>
                            <span class="pictemplate"></span>
                            <span class="infotemplate"><span class="Displayname"></span></span>
                        </ol>
                        <ol>
                            <span class="pictemplate"></span>
                            <span class="infotemplate"><span class="Displayname"></span></span>
                        </ol>
                        <ol>
                            <span class="pictemplate"></span>
                            <span class="infotemplate"><span class="Displayname"></span></span>
                        </ol>
                    </div>
                </div>
                <section>
                    <div class="stdCnt">Student:
                        <span><?php echo $result['total_students'] ?></span>
                    </div>
                    <div class="ovCrs">
                        <i class="fa-solid fa-square-plus" title="Enroll This Course" id="add_course_package"></i>
                    </div>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($resultforp['program_pic']) ?>" id="coursePic" alt="">
                    <div class="infoEnrl">
                        <h4 id="wl<?php echo $result['course_id'] ?>"><?php echo $result['crsAcronym'] ?></h4>
                        <p><?php echo $result['course'] ?></p>
                    </div>
                </section>
<?php
            }
        } else {
            echo 'No Courses found!';
        }

        // Free the statement resources
        $stmt = null;
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
?>