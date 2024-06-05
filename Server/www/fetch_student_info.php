<?php
$servername = "localhost";
$username = "client";  // Add your database username
$password = "1234"; // Add your database password
$dbname = "timetracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the student ID from the query string
$student_id = $_GET['student_id'];

// Query the database for the student information
$sql = "SELECT * FROM students WHERE StudentNumber = '$student_id'";
$result = $conn->query($sql);

// Check if the query returned any results
if ($result->num_rows > 0) {
    // Fetch the student information as an associative array
    $student = $result->fetch_assoc();

    // Return the student information as a JSON object
    header("Content-Type: application/json");
    echo json_encode($student);
} else {
    // Return an error message if no student was found
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'No student found with ID ' . $student_id));
}

// Close the database connection
$conn->close();
?>