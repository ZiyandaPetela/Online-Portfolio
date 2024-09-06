<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Validate form inputs
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validation failed, send an error message
        http_response_code(400);
        echo "Please complete the form and provide a valid email address.";
        exit;
    }

    // Set recipient email address (replace with your email)
    $recipient = "zandapetela@gmail.com";

    // Set the email subject
    $email_subject = "New contact from $name: $subject";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Success message
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        // Failure message
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Deny access if not POST request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
