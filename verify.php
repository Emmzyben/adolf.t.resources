<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form input values
    $firstName = $_POST["fName"];
    $lastName = $_POST["lName"];
    $dateOfIssuance = $_POST["date"];
    $certificateNumber = $_POST["number"];

    // Establish a database connection (you need to replace these with your actual database credentials)
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $database = "adolph.t database";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query with placeholders to prevent SQL injection
    $sql = "SELECT * FROM certificate_registration 
            WHERE first_name = ? 
            AND last_name = ? 
            AND date_of_issuance = ? 
            AND hash_field = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssss", $firstName, $lastName, $dateOfIssuance, $certificateNumber);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were found
    if ($result->num_rows > 0) {
        echo "<div style='background-color: purple;
            width: 80%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            color: white;
            border-radius: 10px;'>
            <h1>Congratulations!</h1>
            <h2>Your certificate is valid!</h2>
            <p>Here is a summary of your Certificate details:</p>";

        while ($row = $result->fetch_assoc()) {
            echo "<div style='border: 1px solid white; padding: 10px; margin: 10px;'>";
            echo "<p><strong>Registration ID:</strong> " . $row["registration_id"] . "</p>";
            echo "<p><strong>First Name:</strong> " . $row["first_name"] . "</p>";
            echo "<p><strong>Last Name:</strong> " . $row["last_name"] . "</p>";
            echo "<p><strong>Date of Issuance:</strong> " . $row["date_of_issuance"] . "</p>";
            echo "<p><strong>Other Details:</strong><br>" . 
                "Address: " . $row["address"] . "<br>" . 
                "City: " . $row["city"] . "<br>" . 
                "State: " . $row["state"] . "<br>" . 
                "Country: " . $row["country"] . "<br>" . 
                "Phone Number 1: " . $row["phone_number1"] . "<br>" . 
                "Phone Number 2: " . $row["phone_number2"] . "<br>" . 
                "Skill Learnt: " . $row["skill_learnt"] . "</p>";
            echo "</div>";
        }

        echo "<a style='text-decoration: underline;color: aqua;' href='certificate-verification.html'>Click to go back</a>";
        echo "</div>";
    } else {
        echo '<div style="font-size :25px; color:purple;">';
        echo "No matching certificates found.";
        echo '<br>Redirecting.....';
        echo '<script>setTimeout(function() { window.location = "certificate-verification.html"; }, 1500);</script>';
        echo '</div>';
      
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
