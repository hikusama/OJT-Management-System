<?php
    require_once '../../includes/session.php';
    require_once '../../includes/config.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];
    $student_id = $_POST["student_id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $middlename = $_POST["middlename"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $school_yr = $_POST["school_yr"];
    $course = $_POST["course"];
    $department = $_POST["department"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];

    $user_role = "Student";
    $options = [
        'cost' => 12
    ];
    //to create the account of student
    $hashedpassword = password_hash($userpassword, PASSWORD_BCRYPT, $options);
    $query = "INSERT INTO user_signup (username, userpassword, user_role) VALUES (:username, :userpassword, :user_role);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":userpassword", $hashedpassword);
    $stmt->bindParam(":user_role", $user_role);
    $stmt->execute();
    //to entolled trainee in the trainee table
    $query = "INSERT INTO trainee (student_id, firstname, lastname, middlename, gender, address, school_yr, course, department, email, contact)
    VALUES (:student_id, :firstname, :lastname, :middlename, :gender, :address, :school_yr, :course, :department, :email, :contact);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":middlename", $middlename);
    $stmt->bindParam(":gender", $gender);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":school_yr", $school_yr);
    $stmt->bindParam(":course", $course);
    $stmt->bindParam(":department", $department);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":contact", $contact);
    $stmt->execute();
        if(isset($_POST["userid"]) && !empty($_POST["userid"])){
            $query = "DELETE FROM user_info WHERE userid = :userid;";
            if($stmt = $pdo->prepare($query)){
                $stmt->bindParam(":userid", $param_userid);
        
                // Set parameters
                $param_userid = trim($_POST["userid"]);
                if($stmt->execute()){
                    header("Location: ../Admit/index.php");
                    die();
                }
            }
            unset($stmt);
    
            // Close connection
            unset($pdo);
        }else{
            echo '<br>';
            echo 'error deleting user';
            die();
        }

}

// }esle{
//     //header("Location: ../AddCoordinator/index.php");
//     //die();
// }
    