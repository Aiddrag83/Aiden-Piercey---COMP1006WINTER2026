<?php
include("../config/database.php");
include("../includes/header.php");

// Get ID from URL
if (!isset($_GET['id'])) {
    die("Resume ID not provided.");
}

$id = $_GET['id'];

// Fetch existing resume
$stmt = $conn->prepare("SELECT * FROM resumes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Resume not found.");
}

$resume = $result->fetch_assoc();

// Handle form submission
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

    // Validation
    if (empty($first_name)) $errors[] = "First name is required.";
    if (empty($last_name)) $errors[] = "Last name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required.";
    if (!preg_match("/^[0-9]{10}$/", $phone)) $errors[] = "Phone must be 10 digits.";

    if (empty($errors)) {

        $stmt = $conn->prepare("UPDATE resumes SET
            first_name = ?,
            last_name = ?,
            current_position = ?,
            skills = ?,
            email = ?,
            phone = ?,
            bio = ?
            WHERE id = ?
        ");

        $stmt->bind_param("sssssssi",
            $first_name,
            $last_name,
            $current_position,
            $skills,
            $email,
            $phone,
            $bio,
            $id
        );

        $stmt->execute();

        echo "<div class='alert alert-success'>Resume updated successfully.</div>";
    }
}
?>

<h2>Edit Resume</h2>

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
        <input type="text" name="first_name" class="form-control"
               value="<?php echo htmlspecialchars($resume['first_name']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control"
               value="<?php echo htmlspecialchars($resume['last_name']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Current Position</label>
        <input type="text" name="current_position" class="form-control"
               value="<?php echo htmlspecialchars($resume['current_position']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Skills</label>
        <input type="text" name="skills" class="form-control"
               value="<?php echo htmlspecialchars($resume['skills']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control"
               value="<?php echo htmlspecialchars($resume['email']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control"
               value="<?php echo htmlspecialchars($resume['phone']); ?>"
               pattern="[0-9]{10}" required>
    </div>

    <div class="mb-3">
        <label>Bio</label>
        <textarea name="bio" class="form-control" rows="4" required><?php
            echo htmlspecialchars($resume['bio']);
        ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Resume</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>

</form>

<?php include("../includes/footer.php"); ?>