<?php
/*Create an admin page that:

- Retrieves all book reviews from the database
- Displays them in a dynamically generated HTML table
- Includes Update and Delete options for each review
The admin must be able to:

- Select a review
- Load the existing data into a form
- Edit the values
- Save the changes to the database
The admin must be able to:

- Delete a selected review from the database

*/
require "includes/header.php";
require "includes/connect.php";
?>
<main class="container mt-5">
<!-- Admin page to manage book reviews -->
<h1>Manage Book Reviews</h1>
<!-- Table to display all reviews -->
<table class="table table-striped">

<thread>
<tr>
<th>ID</th>
<th>Title</th>
<th>Author</th>
<th>Rating</th>
<th>Review</th>
<th>Created at</th>
</tr>
</thread>
<tbody>
    <?php foreach ($reviews sa $review); ?>
    <tr>
    <td><?=htmlspecialchars($review['id'])?></td>
    <td><?=htmlspecialchars($review['title'])?></td>
    <td><?=htmlspecialchars($review['author'])?></td>
    <td><?=htmlspecialchars($review['rating'])?></td>
    <td><?=htmlspecialchars($review['review'])?></td>
    <td><?=htmlspecialchars($review['created_at'])?></td>
    <td>