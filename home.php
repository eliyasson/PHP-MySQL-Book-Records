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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .delete-btn:hover {
            color: #fff; 
            background-color: #ff0000; 
            border-color: #ff0000; 
        }

        .update-btn:hover {
            color: #fff; 
            background-color: #00ff00; 
            border-color: #00ff00;
        }
    </style>
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
        echo '<div class="modal-content rounded-3 shadow">';
        echo '<div class="modal-body text-center">';
           echo '<p class="mb-0">Author: ' . htmlspecialchars($row['author']) . '</p>';
           echo '<p class="mb-0">Title: ' . htmlspecialchars($row['title']) . '</p>';
           echo '<p class="mb-0" >Category: ' . htmlspecialchars($row['catagory']) . '</p>';
           echo '<p class="mb-0">Year: ' . htmlspecialchars($row['year']) . '</p>';
           echo '<p class="mb-0">ISBN: ' . htmlspecialchars($row['isbn']) . '</p>';
           echo '<p class="mb-0">Quantity: ' . htmlspecialchars($row['quantity']) . '</p>';
        echo '</div>';
       echo '<div class="button-group modal-footer d-flex justify-content-center">';
           echo '<form action="home.php" method="post" class="d-inline-block me-3">';
               echo '<input type="hidden" name="delete" value="yes">';
               echo '<input type="hidden" name="isbn" value="' . htmlspecialchars($row['isbn']) . '">';
               echo '<input class="delete-btn btn btn-lg btn-link fs-6 text-decoration-none rounded-0 border-end" fdprocessedid="2ld1d4"" type="submit" value="DELETE RECORD">';
           echo '</form>';
               echo '<form action="update.php" method="post" class="d-inline-block">';
               echo '<input type="hidden" name="isbn" value="' . htmlspecialchars($row['isbn']) . '">';
               echo '<input class="update-btn btn btn-lg btn-link fs-6 text-decoration-none rounded-0 border-end" fdprocessedid="2ld1d4"" type="submit" value="UPDATE">';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>
    
 <!--    <div class="modal-content rounded-3 shadow">
      <div class="modal-body p-4 text-center">
        <h5 class="mb-0">Enable this setting?</h5>
        <p class="mb-0">You can always change your mind in your account settings.</p>
      </div>
      <div class="modal-footer flex-nowrap p-0">
        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" fdprocessedid="2ld1d4"><strong>Yes, enable</strong></button>
        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal" fdprocessedid="0j324m">No thanks</button>
      </div>
    </div> -->