

<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}


require_once '../../../includes/config.php';

$searchQuery = isset($_POST['searchSupV']) ? $_POST['searchSupV'] : '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once '../homeModel.php';

    $studId = getStudId($pdo,intval($_SESSION["user_id"]));
    



    try {

        $sql = "SELECT 
        sp.firstname,
        sp.lastname,
        sp.profile_pic,
        sp.supervisor_info_id,
        department.deptAcronym,
        COUNT(trainee.supervisor_info_id) AS total_trainee
    FROM 
        supervisors AS sp
    LEFT JOIN 
        trainee ON trainee.supervisor_info_id = sp.supervisor_info_id
    LEFT JOIN 
        department ON department.department = sp.department
    WHERE 
        sp.supervisor_info_id NOT IN (
            SELECT 
                r.supervisor_id 
            FROM 
                request r
            WHERE 
                r.stu_id = :studId
                AND r.request_status = 'Pending' 
                AND r.requested_to = 'Supervisor'
        )

    

        ";

        if (!empty($searchQuery)) {
            $sql .= 'AND (sp.firstname LIKE :searchQuery 
            OR sp.lastname LIKE :searchQuery)';
        }

        $sql .= 'GROUP BY 
        sp.supervisor_info_id, 
        sp.firstname, 
        sp.lastname, 
        sp.profile_pic, 
        department.deptAcronym; LIMIT 0, 25';

        $stmt = $pdo->prepare($sql);
        if (!empty($searchQuery)) {
            $searchParam = "%$searchQuery%";
            $stmt->bindParam(':searchQuery', $searchParam);
        }
        $stmt->bindParam(':studId', $studId);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo '                    <div class="loadli">
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
            </div>'; 
            foreach ($results as $result) {
                if ($result['total_trainee'] < 5 ) {
                    $colorMax = 'rgb(0 142 57)';
                }else{
                    $colorMax = 'rgb(227 9 9)';
                }
                echo '
                    <li>
                    <div class="traineeCount">Trainee:<span style="color:'.$colorMax.'">'. $result['total_trainee'] .'/5</span></div>
                    <div class="ovCrs">
                    <i class="fas fa-flag act1" title="Request" id="reqToSupV"></i>
                    <i class="fa-solid fa-person-circle-exclamation act3" title="View Personal Info." id="dep'. $result["supervisor_info_id"] . '"></i>
                    
                    </div>
                    <div class="picEnrollee">
                        <img id="enrolProfPic" src="data:image/jpeg;base64,' . base64_encode($result["profile_pic"]) . '">
                        </div>
                        <div class="infoNotEnroll">
                            <h5 id="sp' . $result['supervisor_info_id'] . '">' . $result["lastname"] . ', '  . $result["firstname"] . '</h5>
                            <p>' . $result['deptAcronym'] . '</p>
                        </div>
                    </li>
                ';
            }
        }else{
            echo 'No supervisor found.';
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
