<?php
// Set your email address
$to = 'tonictech154@gmail.com';

// Get form data
$name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
$email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
$phone = isset($_POST['phone']) ? strip_tags($_POST['phone']) : '';
$subject = isset($_POST['subject']) ? strip_tags($_POST['subject']) : 'Consultation Request';
$message = isset($_POST['message']) ? strip_tags($_POST['message']) : '';

// Validate required fields
if (!$name || !$email || !$message) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
    exit;
}

// Build email content
$email_content = "New Consultation Request:\n\n";
$email_content .= "Name: $name\n";
$email_content .= "Email: $email\n";
$email_content .= "Phone: $phone\n";
$email_content .= "Subject: $subject\n";
$email_content .= "Message:\n$message\n";

// Set headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
if (mail($to, $subject, $email_content, $headers)) {
    echo json_encode(['status' => 'success', 'message' => 'Your consultation request has been sent. Thank you!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send your request. Please try again later.']);
}
?>
