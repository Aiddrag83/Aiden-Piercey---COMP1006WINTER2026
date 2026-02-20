<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../config/database.php");
include("../includes/header.php");

$result = $conn->query("SELECT * FROM resumes ORDER BY created_at DESC");
?>

<h2>All Resumes</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
    <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
    <td><?php echo $row['current_position']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td>
        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
    </td>
</tr>

<?php } ?>

    </tbody>
</table>

<?php include("../includes/footer.php"); ?>