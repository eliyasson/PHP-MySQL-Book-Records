<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $message = $_POST['message'];
    $timestamp = date('Y-m-d H:i:s'); // Format the timestamp as per your database column

    $query = "INSERT INTO messages (username, message, timestamp) VALUES ('$username', '$message', '$timestamp')";
    $result = $conn->query($query);

    if (!$result) {
        echo "INSERT failed: " . $conn->error;
    }
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = "UPDATE messages SET is_deleted = 1 WHERE id = $delete_id";
    $result_delete = $conn->query($delete_query);

    if (!$result_delete) {
        echo "DELETE failed: " . $conn->error;
    } else {
        echo "<p>Message deleted. <a href='chat.php?undo=$delete_id'>Undo</a></p>";
    }
}
if (isset($_GET['undo'])) {
    $undo_id = $_GET['undo'];
    $undo_query = "UPDATE messages SET is_deleted = 0 WHERE id = $undo_id";
    $result_undo = $conn->query($undo_query);

    if (!$result_undo) {
        echo "UNDO failed: " . $conn->error;
    } else {
        echo "<p>Message restored.</p>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .chat-container {
            max-width: 40%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        input[type="text"],
        textarea {
            width: 30%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100px;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .message {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .message-container {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .user-message {
            background-color: #cceeff;
        }
        .librarian-reply {
            background-color: #ffcc99;
        }
        .message-info {
            font-size: 14px;
            color: #666;
        }
        .delete-link {
            color: red;
            text-decoration: none;
            margin-left: 10px;
        }
        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body  style="isolation: isolate;">
<div class="container py-3">
     
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
	    <a href="frontpage.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
		<svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>
                <span class="fs-4">Mysqli Kirjasto</span>
                </a>	   
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="availablebook.php">kirjalisraus</a>
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="borrow.php">Laitteiden Lainaus</a>
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="wishlist.php">Wish List</a>

                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="chat.php">Chat</a>
                <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">Logout</a>
            </nav>

        </div>
        
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal text-body-emphasis">Tervetuloa Kyläkirjastoon</h1>
            <p class="fs-5 text-body-secondary">Täällä voit keskustella kirjaston henkilökunnan kanssa avun saamiseksi.</p>
        </div>


    <form action="chat.php" method="post">
        <pre>
            Username: <input type="text" name="username">
            Message: <textarea name="message"></textarea>
            <input type="submit" value="Send">
        </pre>
    </form>

    <?php
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

        echo "<div class='message-container";
        if (empty($reply)) {
            echo " user-message'>";
        } else {
            echo " librarian-reply'>";
        }

        echo "<p><strong>Your name:</strong> $username</p>";
        echo "<p><strong>Message:</strong> $message</p>";
        echo "<p class='message-info'><strong>Timestamp:</strong> $timestamp</p>";

        if (!empty($reply)) {
            echo "<p><strong>Librarian's Reply:</strong> $reply</p>";
        }

        echo "<a class='delete-link' href='chat.php?delete=$id'>Delete</a>";
        echo "</div>";
    }

    $result->free_result();
    $conn->close();
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

