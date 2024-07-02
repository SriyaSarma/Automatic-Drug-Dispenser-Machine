<?php
header("Content-Type: application/json");

// Get data from the POST request
$data = json_decode(file_get_contents("php://input"), true);

$to_email = $data['to_email'];
$subject = $data['subject'];
$body = $data['body'];
$attachment = $data['attachment'];

// Define your email configuration
$sender_email = 'your_email@gmail.com'; // Replace with your sender email
$sender_password = 'your_email_password'; // Replace with your sender email password

// Create a boundary for the email
$boundary = md5(time());

// Headers for the email
$headers = "From: $sender_email\r\n";
$headers .= "Reply-To: $sender_email\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

// Body of the email
$message = "--$boundary\r\n";
$message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$message .= "$body\r\n";

// Attachment
$file_content = file_get_contents($attachment);
$file_encoded = chunk_split(base64_encode($file_content));

$message .= "--$boundary\r\n";
$message .= "Content-Type: application/octet-stream; name=\"qrcode.png\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n";
$message .= "Content-Disposition: attachment\r\n\r\n";
$message .= $file_encoded . "\r\n";

// End of email
$message .= "--$boundary--";

// Additional headers
$headers .= "MIME-Version: 1.0\r\n";

// Send the email
$mail_sent = mail($to_email, $subject, $message, $headers);

// Return JSON response
$response = ['success' => $mail_sent];
echo json_encode($response);
?>
