
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

$query = "SELECT * FROM devices";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo "Query preparation error: " . $conn->error;
    exit();
}

$stmt->execute();
$result = $stmt->get_result();
$devices = [];
while ($row = $result->fetch_assoc()) {
        $devices[] = $row;
}
$stmt->close();
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Document</title>
    <style>
        .book {
            width: 20%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
            background-color: #f4f4f4;
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
      <a href="welcome.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">

</svg>
        <span class="fs-4">Mysqli Kirjasto</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="user.php">kirjalisraus</a>
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">Laitteiden Lainaus</a>
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
     <?php foreach ($books as $book): ?>
            <div class="book">
                <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Ilmainen</h4>
                </div>
                <p>Device: <?php echo htmlspecialchars($device['device']); ?></p>
                <p>Maker: <?php echo htmlspecialchars($maker['maker']); ?></p>
                <p>Model: <?php echo htmlspecialchars($model['model']); ?></p>
                <p>Year: <?php echo htmlspecialchars($year['year']); ?></p>
                <p>Stock: <?php echo htmlspecialchars($stock['stock']); ?></p>
                <p>Loans: <?php echo htmlspecialchars($loans['loans']); ?></p>
                <form action="borrow.php" method="post">
                    <input type="hidden" name="book_id" value="<?php echo $book['isbn']; ?>">
                    <button type="submit" name="borrow_book" class="w-100 btn btn-lg btn-outline-primary">Lainaa</button>
                </form>
            </div>
        </div>
    </div>
 <?php endforeach; ?>
 <script>
    function validateSearch() {
        var searchValue = document.getElementById('searchInput').value;
        if (searchValue.trim() === '') {
            alert('Please enter a search query.');
            return false;
        }
        return true;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

