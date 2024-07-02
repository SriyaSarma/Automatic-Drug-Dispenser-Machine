<?php
    $name = $_POST["name"];
    $date = $_POST["date"];
    $age = $_POST["Age"];
    $email = $_POST["Email"];
    $gender = isset($_POST["Gender"]) ? $_POST["Gender"] : "";
    $blood_pressure = $_POST["Blood_pressure"];
    $height = $_POST["Height"];
    $weight = $_POST["Weight"];
    $sugar = $_POST["Sugar"];
    $phone_number = $_POST["text"];

    // Insert data into the database
    $conn = new mysqli('localhost','root','','website');
    if($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO recorder(name, date, age, email, gender, blood_pressure, height, weight, sugar, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Error in prepare statement: ' . $conn->error);
        }
        $stmt->bind_param("siisssssss", $name, $date, $age, $email, $gender, $blood_pressure, $height, $weight, $sugar, $phone_number);
        $stmt->execute();
        echo "<script>
                alert('Registered successfully');
                window.location.href='option.html';
              </script>";
        $stmt->close();
        $conn->close();
    }
?>