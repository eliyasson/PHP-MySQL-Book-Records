<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Fatal error");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
        background-image: linear-gradient(0deg, #D9AFD9 0%, #97D9E1 100%);
         }
        .book {
            width: 20%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        }
        .book p {
            margin: 5px 10px;
        }
    </style>

</head>
<body style="isolation: isolate;">
<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                <span class="fs-4">Mysqli Kirjasto</span>
            </a>

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
            <p class="fs-5 text-body-secondary">Täällä voit nähdä saatavilla olevat kirjat</p>
        </div>
    </header>
     <?php
       if (isset($_POST['author'])) {
        $author = $_POST['author'];
        $query = "SELECT * FROM books WHERE author LIKE '%$author%'";
        $result = $conn->query($query);
    
        if (!$result) {
            echo "Could not search<br><br>";
        } else {
            echo '<div id="searchResults">'; // Opening the searchResults container
    
            while ($row = $result->fetch_assoc()) {
                
                $author = $row['author'];
                $title = $row['title'];
                $publisher = $row['publisher'];
                $category = $row['category'];
                $year = $row['year'];
                $isbn = $row['isbn'];
                $note = $row['note'];
                $description = $row['description'];
                $language = $row['language'];
                $type = $row['type'];
                echo '<div class="book col">';
                echo '<div class="card mb-4 rounded-3 shadow-sm">';
                echo '<div class="card-header py-3"><h4 class="my-0 fw-normal">Ilmainen</h4></div>';
                echo "Author: $author<br>Title: $title<br>Publisher: $publisher<br>Category: $category<br>Year: $year<br>ISBN: $isbn<br>Note: $note<br>Description: $description<br>Language: $language<br>Type: $type<br><br>";
                echo '</div></div>';
            }
    
            echo '</div>'; // Closing the searchResults container
        }
    
        // JavaScript to clear search results after 5 seconds
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    const searchResultsContainer = document.getElementById("searchResults");
                    if (searchResultsContainer) {
                        searchResultsContainer.innerHTML = ""; // Clear search results container
                    }
                }, 5000);
            });
        </script>';
        }
     ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>