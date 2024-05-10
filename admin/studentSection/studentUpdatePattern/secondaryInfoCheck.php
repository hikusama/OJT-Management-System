<?php




require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and remove spaces from inputs
    // Function to sanitize input
    function modiPass(&$modifieds, $orig, $changeable, $value)
    {
        if ($orig != $changeable) {
            return  $modifieds[$value . '_modified'] = $value;
        }
    }

    function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Sanitize inputs

    $Origstudent_id = intval($_POST["student_idcc"]);
    $Origfirstname = sanitizeInput($_POST["fnameec"]);
    $Origlastname = sanitizeInput($_POST["lnameec"]);
    $Origmiddlename = sanitizeInput($_POST["mnamec"]);
    $Origyear_level = sanitizeInput($_POST["YLc"]);
    $Origgender = sanitizeInput($_POST["gendercc"]);
    $Origcontact = intval($_POST["contactcc"]);
    $Origaddress = sanitizeInput($_POST["addresscc"]);
    $Origdepartment = sanitizeInput($_POST["departmentecc"]);
    $Origcourse = sanitizeInput($_POST["coursecc"]);

    $student_id = intval($_POST["student_idc"]);
    $firstname = sanitizeInput($_POST["fname"]);
    $lastname = sanitizeInput($_POST["lname"]);
    $middlename = sanitizeInput($_POST["mnamecc"]);
    $year_level = sanitizeInput($_POST["YL"]);
    $gender = sanitizeInput($_POST["genderc"]);
    $contact = intval($_POST["contactc"]);
    $address = sanitizeInput($_POST["addressc"]);
    $department = sanitizeInput($_POST["departmentec"]);
    $course = sanitizeInput($_POST["coursec"]);
    $genderREq = ['Female', 'Male'];







    $modifieds = [];
    $errors = [];
    try {

        require_once 'updateModel.php';
        require_once 'updateController.php';

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $fileSize = $_FILES['image']['size']; // Size of the uploaded file in bytes

            $maxFileSize = 1 * 1024 * 1024;

            if (in_array($fileExtension, $allowedExtensions)) {
                if ($fileSize <= $maxFileSize) {
                    $ImageData = file_get_contents($_FILES['image']['tmp_name']);
                } else {
                    $errors["pic_error"] = "The file size exceeds the maximum allowed limit (1 MB)!";
                }
            } else {
                $errors["pic_error"] = "Only JPG and PNG files are allowed for profile pictures!";
            }
        } else {
            $errors["pic_error"] = "Please choose a profile pic!";
        }
        if (!in_array($gender, $genderREq)) {
            $errors["gender_error"] = "Invalid Gender!";
        }
        if ($Origstudent_id != $student_id) {
            if (is_studno_exist($pdo, $student_id)) {
                $errors["studno_error"] = "Student No. already exist!";
            }
        }



        // $Orig student_id = intval($_POST["student_idcc"]);
        // $Orig firstname = sanitizeInput($_POST["fnameec"]);
        // $Orig lastname = sanitizeInput($_POST["lnameec"]);
        // $Orig middlename = sanitizeInput($_POST["mnamec"]);
        // $Orig year_level = sanitizeInput($_POST["YLc"]);
        // $Orig gender = sanitizeInput($_POST["gendercc"]);
        // $Orig contact = intval($_POST["contactcc"]);
        // $Orig address = sanitizeInput($_POST["addresscc"]);
        // $Orig department = sanitizeInput($_POST["departmentecc"]);
        // $Orig course = sanitizeInput($_POST["coursecc"]);


        if (isset($_POST["changed"])) {
            $modifieds['picture_modified'] = 'Profile picture';
        }

        modiPass($modifieds, $Origstudent_id, $student_id, 'Student No.');
        modiPass($modifieds, $Origfirstname, $firstname, 'Firstname');
        modiPass($modifieds, $Origlastname, $lastname, 'Lastname');
        modiPass($modifieds, $Origmiddlename, $middlename, 'Middlename');
        modiPass($modifieds, $Origyear_level, $year_level, 'Year level');
        modiPass($modifieds, $Origgender, $gender, 'Gender');
        modiPass($modifieds, $Origcontact, $contact, 'Contact');
        modiPass($modifieds, $Origaddress, $address, 'Address');
        modiPass($modifieds, $Origdepartment, $department, 'Department');
        modiPass($modifieds, $Origcourse, $course, 'Course');






        if (is_empty_update_personal_inputs(
            $student_id,
            $firstname,
            $lastname,
            $middlename,
            $year_level,
            $gender,
            $contact,
            $address,
            $department,
            $course
        )) {
            $errors["empty_inputs"] = "Please fill all fields";
        }


        if (!$errors) {
            if ($modifieds) {
                echo '<h4 class="setd" style="color:rgb(2, 136, 189); font-family:sans-serif;">Update Ready</h4>';
                echo '<div style="text-align:start; display:grid; place-items:center;" class="allmodified" >';
                echo '<div style="width:fit-content;" >';
                echo '<h4 style="color:rgb(175 135 0); margin-top:.5rem;">Note: </h4>';
                foreach ($modifieds as $modified) {
                    $from = '';
                    switch ($modified) {
                        case 'Student No.':
                            $from = $Origstudent_id;
                            break;
                        case 'Firstname':
                            $from = $Origfirstname;
                            break;
                        case 'Lastname':
                            $from = $Origlastname;
                            break;
                        case 'Middlename':
                            $from = $Origmiddlename;
                            break;
                        case 'Year level':
                            $from = $Origyear_level;
                            break;
                        case 'Gender':
                            $from = $Origgender;
                            break;
                        case 'Contact':
                            $from = $Origcontact;
                            break;
                        case 'Address':
                            $from = $Origaddress;
                            break;
                        case 'Department':
                            $from = $Origdepartment;
                            break;
                        case 'Course':
                            $from = $Origcourse;
                            break;

                        default:

                            break;
                    }
                    if ($modified === 'Profile picture') {
                        echo '<p class="formError" style="color:rgb(175 135 0)"><span style="color:rgb(175 135 0); font-weight:900;">"' . $modified . '"</span> Modified!!</p>';
                    } else {
                        echo '<p class="formError" style="color:rgb(175 135 0)">' . $modified . ' Modified From "<span style="color:rgb(175 135 0); font-weight:900;">' . $from . '</span>"</p>';
                    }
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo "Make changes for update";
            }
        } else {
            foreach ($errors as $error) {
                echo '<h4 class="formError" style="color:red;font-family:sans-serif;">' . $error . '</h4>';
            }
        }

        // Output response as JSON
    } catch (PDOException $th) {
        die("Query failed: " . $th->getMessage());
        // $response = array('success' => false, 'message' => 'Query Failed: ' . $th->getMessage());
    }





    // $sql = "SELECT * FROM supervisors WHERE supervisor_info_id = :searchQuery";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['searchQuery' => $searchQuery]);

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);



}
