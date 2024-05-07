<?php

require_once '../../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

    try {

        $sql = 'SELECT students.*, department.deptAcronym
                FROM students
                LEFT JOIN trainee ON students.stu_id = trainee.stu_id
                LEFT JOIN department ON students.department = department.department
                WHERE trainee.stu_id IS NULL';

        // If there's a search query, add it to the SQL query
        if (!empty($searchQuery)) {
            $sql .= ' AND (students.firstname LIKE :searchQuery 
                        OR students.lastname LIKE :searchQuery 
                        OR department.deptAcronym LIKE :searchQuery)';
        }

        $stmt = $pdo->prepare($sql);

        if (!empty($searchQuery)) {
            $searchParam = "%$searchQuery%";
            $stmt->bindParam(':searchQuery', $searchParam);
        }

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {

            foreach ($results as $result) {
                echo '
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
                    <li>
                        <div class="picEnrollee">
                            <img id="enrolProfPic" src="data:image/jpeg;base64,' . base64_encode($result["profile_pic"]) . '">
                        </div>
                        <div class="infoNotEnroll">
                            <h5>' . $result["lastname"] . ', '  . $result["firstname"] . '</h5>
                            <p>' . $result['deptAcronym'] . '</p>
                        </div>
                    </li>
                ';
            }
        }
    } catch (\Throwable $th) {
        // Handle exceptions here
    }
}
?>
