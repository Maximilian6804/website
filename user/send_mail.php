<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    // Email address to send the message to
    $to = "contact@maximilianschmitz.de";
    
    // Format email text
    $email_body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message\n";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "<script>alert('Your message has been sent!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Error sending message.'); window.location.href='contact.html';</script>";
    }
} else {
    echo "Invalid request.";
}
?>
