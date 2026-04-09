<?php
/*****************************************
 * COMP 1006 – Lab 3
 * Order Form Processing
 *****************************************/

$errors = [];
$orderSummary = "";

/* Sanitize input */
function cleanInput($value) {
  return htmlspecialchars(trim($value));
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: order.php");
  exit;
}

/* Collect & sanitize customer info */
$firstName = cleanInput($_POST["first_name"] ?? "");
$lastName  = cleanInput($_POST["last_name"] ?? "");
$phone     = cleanInput($_POST["phone"] ?? "");
$address   = cleanInput($_POST["address"] ?? "");
$email     = cleanInput($_POST["email"] ?? "");
$comments  = cleanInput($_POST["comments"] ?? "");

/* Server-side validation */
if (empty($firstName)) $errors[] = "First name is required.";
if (empty($lastName))  $errors[] = "Last name is required.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "A valid email address is required.";
}
if (empty($address))   $errors[] = "Address is required.";

/* Order validation */
$items = $_POST["items"] ?? [];
$totalItems = 0;

foreach ($items as $qty) {
  $totalItems += (int)$qty;
}

if ($totalItems === 0) {
  $errors[] = "You must order at least one item!!";
}

/* If errors, display them */
if (!empty($errors)) {
  require "includes/header.php";
  echo "<h2 class='error'>Order Error</h2><ul class='error'>";
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo "</ul><p><a href='order.php'>Go back to the form</a></p>";
  require "includes/footer.php";
  exit;
}

/* Build order summary */
$orderSummary .= "Customer: $firstName $lastName\n";
$orderSummary .= "Phone: $phone\n";
$orderSummary .= "Email: $email\n";
$orderSummary .= "Address: $address\n\nOrder:\n";

foreach ($items as $item => $qty) {
  if ($qty > 0) {
    $orderSummary .= ucfirst(str_replace("_", " ", $item)) . ": $qty\n";
  }
}

if (!empty($comments)) {
  $orderSummary .= "\nComments:\n$comments\n";
}

/* Send email (may not send locally – OK for lab) */
$to = "info@Dragden.ca";
$subject = "New Game Ordered";
$headers = "From: $email";

mail($to, $subject, $orderSummary, $headers);

/* Confirmation output */
require "includes/header.php";
?>

<h2 class="success">Order Confirmed 🎉</h2>

<p>Thank you, <strong><?= $firstName ?></strong>! Your order has been received.</p>

<pre><?= $orderSummary ?></pre>

<p>We will contact you shortly to confirm your order.</p>

<?php
require "includes/footer.php";
