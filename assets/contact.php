<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Email settings
        $to = "your-email@example.com"; // Replace with your email address
        $headers = "From: " . $email . "\r\n" .
                   "Reply-To: " . $email . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();
        $fullMessage = "Name: " . $name . "\n" .
                       "Email: " . $email . "\n" .
                       "Message: \n" . $message;

        // Send email
        if (mail($to, $subject, $fullMessage, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send the message. Please try again later.";
        }
    } else {
        echo "Invalid email format!";
    }
}
?>
