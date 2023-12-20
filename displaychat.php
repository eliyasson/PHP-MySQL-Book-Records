
<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

// Check if the form has been submitted (for replying to messages)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reply'])) {
    // Assuming you have a column 'reply' in your messages table
    $reply = $_POST['reply'];
    $message_id = $_POST['message_id'];

    $query = "UPDATE messages SET reply = '$reply' WHERE id = $message_id";
    $result = $conn->query($query);

    if (!$result) {
        echo "Reply failed: " . $conn->error;
    } else {
        echo "<p>Reply sent.</p>";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="tyylit2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="$
</head>
<body style="isolatio: isolate;">
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="frontpage.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                <span class="fs-4">Mysqli Kirjasto</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="home.php">Lisää kirjoja</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="newdevice.php">Lisää laitteita</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="displaywish.php">Customer wishes</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="displaychat.php">viestejä</a>
                    <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">Logout</a>
                </nav>
            </div>
        </header>
    <h3>tämä on asiakasviestejä, voit vastata.</h3>

    <?php
    // Display the messages
    $query = "SELECT * FROM messages WHERE is_deleted = 0 ORDER BY timestamp DESC";
    $result = $conn->query($query);

    if (!$result) {
        die("Database access failed: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['id']);
        $username = htmlspecialchars($row['username']);
        $message = htmlspecialchars($row['message']);
        $timestamp = htmlspecialchars($row['timestamp']);
        $reply = htmlspecialchars($row['reply']);

        echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;'>";
        echo "<p><strong>Username:</strong> $username</p>";
        echo "<p><strong>Message:</strong> $message</p>";
        echo "<p><strong>Timestamp:</strong> $timestamp</p>";

        if (empty($reply)) {
            echo "<form action='displaychat.php' method='post'>";
            echo "<input type='hidden' name='message_id' value='$id'>";
            echo "<textarea name='reply' placeholder='Enter reply'></textarea><br>";
            echo "<input type='submit' value='Reply'>";
            echo "</form>";
        } else {
            echo "<p><strong>Reply:</strong> $reply</p>";
        }

        echo "</div>";
    }

    $result->free_result();
    $conn->close();
    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }
    ?>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

