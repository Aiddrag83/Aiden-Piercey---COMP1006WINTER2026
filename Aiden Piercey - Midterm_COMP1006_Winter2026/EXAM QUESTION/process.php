<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $rating = trim($_POST['rating']);
    $review = trim($_POST['review']);

    // Server-side validation
    if (empty($title)) $errors[] = "Title required.";
    if (empty($author)) $errors[] = "Author required.";
    if (empty($rating)) $errors[] = "Rating required.";
    if (empty($review)) $errors[] = "Review required.";

    if (empty($errors)) {

        $stmt = $conn->prepare("INSERT INTO reviews 
        (title, author, rating, review)
        VALUES (?, ?, ?, ?)");

        $stmt->bind_param("ssss",
            $title,
            $author,
            $rating,
            $review
        );

        $stmt->execute();

        echo "<div class='alert alert-success'>Review added successfully!</div>";
    }
}
?>

<h2>Add Review</h2>

<?php
if (!empty($errors)) {
    echo "<div class='alert alert-danger'>";
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    echo "</div>";
}
?>