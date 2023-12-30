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
	body {
          background-color: #8EC5FC;
          background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);

	}
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
<body style="isolatio: isolate;">
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="frontpage.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
		<svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>
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
    <h2>Tervetuloa, <?php echo $_SESSION['username']; ?>! Voit lisätä kirjat tietokantoihin.</h2>
</div>


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


    if (!empty($author) && !empty($title) && !empty($category) && !empty($year) && !empty($isbn)) {
        $query = "INSERT INTO books (author, title, catagory, year, isbn, quantity) VALUES ('$author', '$title', '$category', '$year', '$isbn', '$quantity')";
        $result = $conn->query($query);

        if (!$result) {
            echo "INSERT failed<br><br>";
        }
    } else {
        echo "Please fill in all fields";
    }
}

    echo <<<HTML
    <form class="container py-3" action="home.php" method="post">
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

