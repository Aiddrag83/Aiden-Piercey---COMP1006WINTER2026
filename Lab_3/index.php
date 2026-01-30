<?php
$errors = [];
$successMessage = "";

/* Sanitize function */
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize inputs
    $firstName = cleanInput($_POST["first_name"] ?? "");
    $lastName  = cleanInput($_POST["last_name"] ?? "");
    $email     = cleanInput($_POST["email"] ?? "");
    $message   = cleanInput($_POST["message"] ?? "");

    /***************************************
     * Server-side validation??
     ***************************************/
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }

    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }

    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    }

    /***************************************
     * Should send email if no errors!!
     ***************************************/
    if (empty($errors)) {
        $to = "info@bakery.com"; // instructor-friendly placeholder
        $subject = "New Contact Form Submission";
        $body = "Name: $firstName $lastName\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        mail($to, $subject, $body, $headers);

        $successMessage = "Thank you! Your message has been sent successfully.";
        
        // Clear form after submission
        $firstName = $lastName = $email = $message = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bakery Contact Form</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: auto; }
        .error { color: red; }
        .success { color: green; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 8px; }
    </style>
</head>

<body>

<h1>Contact Our Bakery</h1>

<?php
/***************************************
 * Confirmation or errors
 ***************************************/
if (!empty($errors)) {
    echo "<div class='error'><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
}

if ($successMessage) {
    echo "<p class='success'>$successMessage</p>";
}
?>

<form method="post" action="">

    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" 
           value="<?= $firstName ?>" required>

    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" 
           value="<?= $lastName ?>" required>

    <label for="email">Email Address</label>
    <input type="email" name="email" id="email" 
           value="<?= $email ?>" required>

    <label for="message">Message</label>
    <textarea name="message" id="message" rows="5" required><?= $message ?></textarea>

    <button type="submit">Send Message</button>
</form>

</body>
</html>
