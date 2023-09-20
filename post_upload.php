<?php
// Database connection parameters
$hostname = 'localhost';
$username = "root";
$password = "";
$database_name = "adolph.t database";

// Create a connection to the database
$mysqli = new mysqli($hostname, $username, $password, $database_name);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo 'Please upload a valid image';
}

// Validate image type and size
$allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxImageSize = 5 * 1024 * 1024; // 5 MB

if (
    !in_array($_FILES['file']['type'], $allowedImageTypes) ||
    $_FILES['file']['size'] > $maxImageSize
) {
    echo 'Please upload a valid image (JPEG, PNG, GIF) within 5 MB.';
}

// Move the uploaded image to a designated upload directory
$uploadDir = 'uploads/';
$uploadedFilePath = $uploadDir . $_FILES['file']['name'];

if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath)) {
    echo 'Failed to move uploaded image to the directory.';
}

$imagePath = $uploadedFilePath;
$postTitle = $_POST["post_title"];
$postContent = $_POST["post_content"];

// Insert data into the "posts" table
$insertSql = "INSERT INTO posts (post_title, post_content, image_path) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($insertSql);
$stmt->bind_param("sss", $postTitle, $postContent, $imagePath);

if ($stmt->execute()) {
    echo '<div style="font-size :25px;color:purple;">'; 
    echo "Post and image uploaded successfully!";
    echo '<script>setTimeout(function() { window.location = "min.php"; }, 5000);</script>';
    echo '<br>Redirecting..........';
    echo '</div>';
 } else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

// Close the database connection
$mysqli->close();
?>
