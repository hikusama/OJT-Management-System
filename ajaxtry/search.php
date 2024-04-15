<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "incent"; // Replace with your MySQL password
$dbname = "porajaxdemo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the search term from the AJAX request
$searchTerm = $_GET['query'];

// SQL query to search for users based on the search term
$sql = "SELECT fname, mname, lname FROM users WHERE fname LIKE '%$searchTerm%' OR mname LIKE '%$searchTerm%' OR lname LIKE '%$searchTerm%'";

// Execute the query
$result = $conn->query($sql);

// Display the search results
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "First Name: " . $row["fname"]. " - Middle Name: " . $row["mname"]. " - Last Name: " . $row["lname"]. "<br>";
    }
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>
