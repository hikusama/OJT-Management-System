<?php




require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and remove spaces from inputs
    // Function to sanitize input
    function modiPass(&$modifieds,$orig, $changeable, $value)
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
    $key = intval($_POST["key"]);
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




        if (isset($_POST["changed"])) {
            $modifieds['picture_modified'] = 'Profile picture';
        }

        modiPass($modifieds,$Origstudent_id, $student_id, 'Student No.');
        modiPass($modifieds,$Origfirstname, $firstname, 'Firstname');
        modiPass($modifieds,$Origlastname, $lastname, 'Lastname');
        modiPass($modifieds,$Origmiddlename, $middlename, 'Middlename');
        modiPass($modifieds,$Origyear_level, $year_level, 'Year level');
        modiPass($modifieds,$Origgender, $gender, 'Gender');
        modiPass($modifieds,$Origcontact, $contact, 'Contact');
        modiPass($modifieds,$Origaddress, $address, 'Address');
        modiPass($modifieds,$Origdepartment, $department, 'Department');
        modiPass($modifieds,$Origcourse, $course, 'Course');






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
                updatePersonal(
                    $pdo,
                    $key,
                    $student_id,
                    $ImageData,
                    $firstname,
                    $lastname,
                    $middlename,
                    $contact,
                    $address,
                    $year_level,
                    $course,
                    $department,
                    $gender
                );
                echo 'success';
            } else {
                echo "<h4 style='color:rgb(2, 136, 189);'>Make changes to update</h4>";
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
