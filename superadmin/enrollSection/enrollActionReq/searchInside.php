

<?php

require_once '../../../includes/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {



    try {


        $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

        $sql = "SELECT students.*
    FROM students
    LEFT JOIN trainee ON students.stu_id = trainee.stu_id
    WHERE trainee.stu_id IS NULL 
    AND (students.firstname LIKE :searchQuery OR students.lastname LIKE :searchQuery)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['searchQuery' => $searchQuery]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {

            foreach ($results as $result) {
                $dept = $result['department'];
                $sql2 = 'SELECT department.* FROM department WHERE department.department = :dept ;';
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam(':dept', $dept);
                $stmt2->execute();

                $results2 = $stmt2->fetch(PDO::FETCH_ASSOC);
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
                    <li >
                    <div class="picEnrollee">
                    <img id="enrolProfPic" src="data:image/jpeg;base64,' . base64_encode($result["profile_pic"]) . '" >
                    </div>
                    <div class="infoNotEnroll" >
                    <h5>' . $result["lastname"] . ', '  . $result["firstname"] . '</h5>
                    <p>' . $results2['deptAcronym'] . '</p>' . '
                    </div>
                    </li>
                ';
            }
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
}
