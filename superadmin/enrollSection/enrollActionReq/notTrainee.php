

<?php

require_once '../../../includes/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    try {

        $sql = 'SELECT students.*
        FROM students
        LEFT JOIN trainee ON students.stu_id = trainee.stu_id
        WHERE trainee.stu_id IS NULL;';
        $stmt = $pdo->prepare($sql);
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
                    <img id="enrolProfPic" src="data:image/jpeg;base64,' . base64_encode($result["profile_pic"]) .'" >
                    <div class="infoNotEnroll" >
                    <h5>' . $result["lastname"] . ', '  . $result["firstname"] . '</h5>
                    <p>'. $result['department'] . '</p>' .'
                    </div>
                    </li>
                ';
            }
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
}
