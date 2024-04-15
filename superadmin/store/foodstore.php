<?php
$foodArray = array("apple", "banana", "orange", "grape", "pear");

if(isset($_POST['food'])) {
    $userInput = $_POST['food'];
    if(in_array($userInput, $foodArray)) {
        echo "<p>$userInput is in the array!</p>";
    } else {
        echo "<p>$userInput is not in the array.</p>";
    }
}
?>
