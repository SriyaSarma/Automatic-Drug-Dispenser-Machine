<?php
// doctor.php

// Function to fetch patient details
function fetchPatientDetails($phoneNumber) {
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'website');

    // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT name, age, email, gender, blood_pressure, height, weight, sugar, phone_number FROM recorder WHERE phone_number = ?";
    $stmt = $conn->prepare($sql);
    
    // Check for a preparation error
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("s", $phoneNumber);
    
    // Execute the statement
    if (!$stmt->execute()) {
        // Log the error
        error_log("Execution failed: " . $stmt->error);
        // Return an error response
        echo json_encode(["error" => "Execution failed"]);
        exit();
    }
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch patient details
    $patientDetails = $result->fetch_assoc();
    
    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Handle no results
    if ($patientDetails !== null) {
        // Return the details as JSON
        echo json_encode($patientDetails);
    } else {
        // Return an error response
        echo json_encode(["error" => "Patient details not found"]);
    }
}

// Check for the action parameter and validate it
if (isset($_POST['action']) && $_POST['action'] === 'fetchPatientDetails') {
    // Assuming phone_number is passed as a parameter
    $phoneNumber = $_POST['phone_number'];
    
    // Validate phone number (you may want to perform more thorough validation)
    if (is_numeric($phoneNumber)) {
        // Fetch patient details
        fetchPatientDetails($phoneNumber);
    } else {
        // Invalid phone number
        echo json_encode(["error" => "Invalid phone number"]);
    }
}
?>