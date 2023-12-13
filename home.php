<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="tyylit2.css">
</head>
<body>
    <h2>Tervetuloa, <?php echo $_SESSION['username']; ?>!</h2>
    
    <form action="logout.php" method="post">
        <input type="submit" style="background-color: red" value="Logout">
    </form>

    <?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Fatal connection Error");
    }

    if (isset($_POST['delete']) && isset($_POST['isbn'])) {
        $isbn = get_post($conn, 'isbn');
        $query = "DELETE FROM books WHERE isbn='$isbn'";
        $result = $conn->query($query);
        if (!$result) {
            echo "DELETE failed<br><br>";
        }
    }

    if (
        isset($_POST['author']) &&
        isset($_POST['title']) &&
        isset($_POST['category']) &&
        isset($_POST['year']) &&
        isset($_POST['isbn']) &&
        isset($_POST['quantity'])
    ) {
        $author = get_post($conn, 'author');
        $title = get_post($conn, 'title');
        $category = get_post($conn, 'category');
        $year = get_post($conn, 'year');
        $isbn = get_post($conn, 'isbn');
        $quantity = get_post($conn, 'quantity');
        
        // Prepared statement to avoid SQL injection
        $query = "INSERT INTO books (author, title, catagory, year, isbn, quantity) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssisi', $author, $title, $category, $year, $isbn, $quantity);
        if ($stmt->execute()) {
            echo "Record added successfully.<br><br>";
        } else {
            echo "INSERT failed<br><br>";
        }
        $stmt->close();
    }

    // Display form for adding records
    echo <<<HTML
    <form action="home.php" method="post">
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
    