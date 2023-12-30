<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit();
}

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Fatal Connection Error");
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
        <p class="fs-5 text-body-secondary">Täällä voit nähdä saatavilla olevat kirjat</p>
        </div>
    </header>
    <?php
        if (isset($_POST['isbn'])) {
            $isbn = $_POST['isbn'];
        
            // Retrieve book details based on ISBN
            $query = "SELECT * FROM books WHERE isbn='$isbn'";
            $result = $conn->query($query);
        
            if (!$result) {
                echo "Error fetching data: " . $conn->error;
            exit(); 
           } else {
                $row = $result->fetch_assoc();
                $quantity = $row['quantity'];
        
                // Check if the book is available
                if ($quantity > 0) {
                    // Reduce the quantity by 1 (assuming a book is borrowed)
                    $newQuantity = $quantity - 1;
        
                    // Update the book quantity in the database
                    $updateQuery = "UPDATE books SET quantity=$newQuantity WHERE isbn='$isbn'";
                    $updateResult = $conn->query($updateQuery);
        
                    if (!$updateResult) {
                        echo "Error updating book quantity: " . $conn->error;
                    } else {
                        // Display book details after borrowing
                        ?>
                        <div class="book">
		                    <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm">
		                            <div class="card-header py-3">
            		                    <h4 class="my-0 fw-normal">Borrowed</h4>
          	                        </div>
                                    <pre>
                                        <p>Author: <?php echo htmlspecialchars($row['author']); ?></p>
                                        <p>Title: <?php echo htmlspecialchars($row['title']); ?></p>
                                        <p>Category: <?php echo htmlspecialchars($row['catagory']); ?></p>
                                        <p>Year: <?php echo htmlspecialchars($row['year']); ?></p>
                                        <p>ISBN: <?php echo htmlspecialchars($row['isbn']); ?></p>
                                        <p>Quantity after borrowing: <?php echo htmlspecialchars($newQuantity); ?></p>
                                        <p>Book borrowed successfully!</p>
                                    </pre>
                                </div>
                           </div>
                        </div>   
                        <?php
                    }
                } else {
                    echo " The book is not available for borrowing. ";
                }
            }
        }
        
        $conn->close();
        
        
    ?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>

