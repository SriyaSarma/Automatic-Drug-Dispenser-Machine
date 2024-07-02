<?php
// ... (your existing code)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : "";

    if ($action === "fetchDetails") {
        $phoneInput = $_POST["phone_number"];

        // Fetch details from the database based on the phone number
        $stmt = $conn->prepare("SELECT * FROM recorder WHERE phone_number = ?");
        $stmt->bind_param("s", $phoneInput);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if details are found
        if ($result->num_rows > 0) {
            // Return details as JSON
            $details = $result->fetch_assoc();
            echo json_encode($details);
        } else {
            echo json_encode(null);
        }

        $stmt->close();
    } else {
        // Handle other actions or form submissions here
        // For example, your existing form submission code can go here
    }
    $conn->close();
    exit;
}
?>
