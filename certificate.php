<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $database = "adolph.t database";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from the form
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $date_of_issuance = $_POST["date_of_issuance"];
    $phone_number1 = $_POST["phone_number1"];
    $phone_number2 = $_POST["phone_number2"];
    $skill_learnt = $_POST["skill_learnt"];

    // Prepare an SQL SELECT statement to check if the user exists
    $check_sql = "SELECT * FROM certificate_registration WHERE first_name = ? AND last_name = ? AND date_of_issuance = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("sss", $first_name, $last_name, $date_of_issuance);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User already exists, display a message
        echo '<div style="font-size :25px;color:purple;">';
        echo "Student with the same information already exists.";
        echo '</div>';
        echo '<script>setTimeout(function() { window.location = "min.php"; }, 2000);</script>';
    } else {
        // User doesn't exist, proceed with inserting data

        // Generate a random number and concatenate it with $date_of_issuance
        $last_insert_id = mt_rand(10000, 99999) ;

        // Prepare an SQL INSERT statement
        $sql = "INSERT INTO certificate_registration (first_name, middle_name, last_name, address, city, state, country, date_of_issuance, phone_number1, phone_number2, skill_learnt, hash_field) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters to the statement
            $stmt->bind_param("ssssssssssss", $first_name, $middle_name, $last_name, $address, $city, $state, $country, $date_of_issuance, $phone_number1, $phone_number2, $skill_learnt, $last_insert_id);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<div style="font-size :25px;color:purple;">';
                echo "Certificate successfully registered. Registration Number:" . htmlspecialchars($last_insert_id, ENT_QUOTES, 'UTF-8');
                echo '<br>Redirecting..........';
                echo '</div>';
                echo '<script>setTimeout(function() { window.location = "min.php"; }, 6000);</script>';
            } else {
                echo "Error inserting data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case when the form was not submitted
    echo "Form was not submitted.";
}
?>
