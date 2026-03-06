<?php
include("../config/database.php");
include("../includes/header.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $current_position = trim($_POST['current_position']);
    $skills = trim($_POST['skills']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $bio = trim($_POST['bio']);

    // Server-side validation
    if (empty($first_name)) $errors[] = "First name required.";
    if (empty($last_name)) $errors[] = "Last name required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required.";
    if (!preg_match("/^[0-9]{10}$/", $phone)) $errors[] = "Phone must be 10 digits.";

    if (empty($errors)) {

        $stmt = $conn->prepare("INSERT INTO resumes 
        (first_name, last_name, current_position, skills, email, phone, bio)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssss",
            $first_name,
            $last_name,
            $current_position,
            $skills,
            $email,
            $phone,
            $bio
        );

        $stmt->execute();

        echo "<div class='alert alert-success'>Resume added successfully!</div>";
    }
}
?>

<h2>Add Resume</h2>

<?php
if (!empty($errors)) {
    echo "<div class='alert alert-danger'>";
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    echo "</div>";
}
?>

<form method="POST">

    <div class="mb-3">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Current Position</label>
        <input type="text" name="current_position" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Skills (comma separated)</label>
        <input type="text" name="skills" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Phone (10 digits)</label>
        <input type="text" name="phone" class="form-control" pattern="[0-9]{10}" required>
    </div>

    <div class="mb-3">
        <label>Bio</label>
        <textarea name="bio" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save Resume</button>
</form>

<?php include("../includes/footer.php"); ?>