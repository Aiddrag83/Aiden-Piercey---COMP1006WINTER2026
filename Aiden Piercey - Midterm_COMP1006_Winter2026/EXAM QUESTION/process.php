<?php

/* Using the provided HTML form:
- Accept user input
- Sanitize and validate the form data on the server
- If valid, store the review in the database
- If invalid, display an error message and do not insert the record
*/ 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
$author  = trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS));
$rating     = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
$feedback     = trim(filter_input(INPUT_POST, 'feedback', FILTER_SANITIZE_SPECIAL_CHARS));

/* At minimum:

- Required fields must not be empty
- Numeric fields must contain valid numbers
- Data must be sanitized before storing
- Invalid data must not be inserted into the database */

//send to the database if valid, otherwise show errors//

if ($title === null || $title === '') {
    die('Title is required.');
}
if ($author === null || $author === '') {
    die('Author Name is required.');
}
if ($rating === null || $rating === '') {
    die('A rating is required.');
}
if ($feedback === null || $feedback === '') {
    die('Feedback is required.');
}