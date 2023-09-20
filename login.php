<?php
session_start(); // Start a session

$servername = 'localhost';
$username = "root";
$password = "";
$database = "adolph.t database";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store user input
$userInputUsername = "";
$userInputPassword = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $userInputUsername = $_POST["username"];
    $userInputPassword = $_POST["password"];

    // Query the database to check if the username and hashed password match
    $sql = "SELECT * FROM Users WHERE Username = '$userInputUsername' AND PasswordHash = '$userInputPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User authentication successful
        $_SESSION['username'] = $userInputUsername; // Store the username in the session
        echo '<script>setTimeout(function() { window.location = "min.php"; }, 1500);</script>';
    } else {
        // User authentication failed
        echo "Authentication failed. Please check your username and password.";
    }
}

// Close the database connection
$conn->close();
?>
