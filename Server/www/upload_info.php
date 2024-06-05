<?php
$servername = "localhost";
$username = "client";  // Add your database username
$password = "1234";    // Add your database password
$dbname = "timetracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : null;
    $college = isset($_POST['course']) ? $conn->real_escape_string($_POST['course']) : null;
    $event_id = isset($_POST['event_id']) ? (int)$_POST['event_id'] : 1;
    $mtime = date("H:i:s", time());

    if ($student_id === "undefined") {
        header('Location: scanner.php');
        exit();
    }

    $result = checkExistence($student_id);

    if($result !== null)
    {
        $sql = "UPDATE attendance_info SET `am_out` = '$mtime' WHERE `student_id` = '$student_id'";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            #header('Location: scanner.php');
            echo "<script>alert('Successful!');</script>";
        } else {
            echo "<script>alert('Error, try again!');</script>";
        }
        $stmt->close();
    }else if($student_id && $name) {
        $sql = "INSERT INTO attendance_info (`student_id`, `name`, `college`, `event_id`, `am_in`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssis", $student_id, $name, $college, $event_id, $mtime);

            if ($stmt->execute()) {
                header('Location: scanner.php');
                echo "<script>alert('Successful!');</script>";
            } else {
                echo "<script>alert('Error, try again!');</script>";
            }
            $stmt->close();
    }else {
        echo "<script>alert('Invalid input. Please check your data.');</script>";
    }
}
function checkExistence($args)
{
    $servername = "localhost";
    $username = "client";  // Add your database username
    $password = "1234"; // Add your database password
    $dbname = "timetracker";

    echo "<script>alert($args)</script>";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Query the database for the student information
    $sql = "SELECT * FROM attendance_info WHERE `student_id` = '$args'";
    $result = $conn->query($sql);

    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Fetch the student information as an associative array
        $row = $result->fetch_assoc();
    
        return $row;
    }else{
        return false;
    }

    
}

$conn->close();
?>
