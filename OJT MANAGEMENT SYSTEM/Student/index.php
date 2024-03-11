<?php
    require_once "../includes/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Student dashboard</h1>
    <break>
    <h2>Classwork</h2>
    <break>
    <h1>
        <?php
        if(isset($_SESSION["user_id"])){
                                        $user_id = $_SESSION["user_id"];
                                        echo '<p>' . $user_id . '</p>';
                                    }else{
                                        echo '<p>id not set</p>';
                                    }
                                    ?>
                                    </h1>
                                    <break>
    <h2>
    <break>
    <a href="find_Supervisor/index.php"><button>department</button></a>
    <form action="logout.php">
        <button>logout</button>
    </form>
    </h2>
</body>
</html>