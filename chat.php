<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get values from the form
    $username = $_POST['username'];
    $message = $_POST['message'];
    
    // Use the current timestamp for the database insertion
    $timestamp = date('Y-m-d H:i:s'); // Format the timestamp as per your database column

    // Insert data into the database
    $query = "INSERT INTO messages (username, message, timestamp) VALUES ('$username', '$message', '$timestamp')";
    $result = $conn->query($query);

    if (!$result) {
        echo "INSERT failed: " . $conn->error;
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
    </style>
</head>
<body  style="isolation: isolate;">
<div class="container py-3">
     
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-$
                </svg>
                <span class="fs-4">Mysqli Kirjasto</span></a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="user.php">kirjalisraus</a>
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
                <hidden input type="text" name="timestamp">
                <input type="submit" value="Send">
            </pre>
        </form>


          <?php
        // Display the messages
        $query = "SELECT * FROM messages";
        $result = $conn->query($query);

        if (!$result) {
            die("Database access failed: " . $conn->error);
        }

        $rows = $result->num_rows;

        for ($j = 0; $j < $rows; ++$j) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $r0 = htmlspecialchars($row['id']);
            $r1 = htmlspecialchars($row['username']);
            $r2 = htmlspecialchars($row['message']);
            $r3 = htmlspecialchars($row['timestamp']);

            echo "<pre>";
            echo "Id: $r0<br>";
            echo "Username: $r1<br>";
            echo "Message: $r2<br>";
            echo "Timestamp: $r3<br>";
            echo "</pre>";
        }

        $result->close();
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
