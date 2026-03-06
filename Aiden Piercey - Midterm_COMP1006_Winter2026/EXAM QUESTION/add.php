<?php
include("../config/database.php");
include("../includes/header.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST")
$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
$author = trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS));
$rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
$review = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS));
if ($title === null || $title === '') {
    $errors[] = "Title is required.";
}
if ($author === null || $author === '') {
    $errors[] = "Author is required.";
}
if ($rating === null || $rating === '') {
    $errors[] = "Rating is required.";
} 
if ($review === null || $review === '') {
    $errors[] = "Review is required.";
}
if (!empty($errors)) {
    echo "<div class='alert alert-danger'>";
    echo "<h2>Please fix the following:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO reviews (title, author, rating, review) VALUES (:title, :author, :rating, :review)");
    $stmt->execute([
        ':title' => $title,
        ':author' => $author,
        ':rating' => $rating,
        ':review' => $review
    ]);
    echo "<div class='alert alert-success'>Review added successfully!</div>";
}
include("../includes/footer.php");
include ("../config/database.php");
include("../includes/header.php");