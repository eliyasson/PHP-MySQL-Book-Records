<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
echo <<<HTML
    <form action="user.php" method="post">
        <pre>
            Author:   <input type="text" name="author">
            Title:    <input type="text" name="title">
            Category: <input type="text" name="category">
            Year:     <input type="text" name="year">
            ISBN:     <input type="text" name="isbn">
            Quantity: <input type="text" name="quantity">
            <input type="submit" value="ADD RECORD">
        </pre>
    </form>
    HTML;

    $query = "SELECT * FROM books";
    $result = $conn->query($query);
    if (!$result) {
        die("Database access failed");
    }

    while ($row = $result->fetch_assoc()) {
        echo '<div class="records">';
        echo '<div class="record">';
        echo '<p>Author: ' . htmlspecialchars($row['author']) . '</p>';
        echo '<p>Title: ' . htmlspecialchars($row['title']) . '</p>';
        echo '<p>Category: ' . htmlspecialchars($row['catagory']) . '</p>';
        echo '<p>Year: ' . htmlspecialchars($row['year']) . '</p>';
        echo '<p>ISBN: ' . htmlspecialchars($row['isbn']) . '</p>';
        echo '<p>Quantity: ' . htmlspecialchars($row['quantity']) . '</p>';
        echo '<div class="button-group">';
        echo '<form action="home.php" method="post">';
        echo '<input type="hidden" name="delete" value="yes">';
        echo '<input type="hidden" name="isbn" value="' . htmlspecialchars($row['isbn']) . '">';
        echo '<input class="delete-btn" type="submit" value="DELETE RECORD">';
        echo '</form>';
        echo '<form action="update.php" method="post">';
        echo '<input type="hidden" name="update" value="yes">';
        echo '<input type="hidden" name="isbn" value="' . htmlspecialchars($row['isbn']) . '">';
        echo '<input class="update-btn" type="submit" value="UPDATE">';
        echo '</form>';
        echo '</div></div></div>';
    }

    $result->close();
    $conn->close();

    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }
    ?>
</body>
</html>