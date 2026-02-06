<?php
/* made it more managable by separating PHP and HTML */

$pageTitle = "My PHP Page";

$items = [
    "Home",
    "About",
    "Contact"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
</head>

    <body>
        <header>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
        </header>

    <main>
        <ul>
            <?php foreach ($items as $item): ?>
            <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
        </ul>
    </main>

        <footer>
        <p>&copy; 2026</p>
        </footer>

    </body>
</html>
