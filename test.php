

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
      <a href="" class="d-flex align-items-center link-body-emphasis text-decoration-none">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
         <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-$
        </svg>
        <span class="fs-4">Mysqli Kirjasto</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="user.php">kirjalisraus</a>
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">Laitteiden Lainaus</a>
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="chat.php">Chat</a>
        <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">Logout</a>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal text-body-emphasis">Tervetuloa Kyläkirjastoon</h1>
      <p class="fs-5 text-body-secondary">Täällä voit nähdä saatavilla olevat kirjat, lainata laitteita ja keskustella kirjaston henkilökunnan kanssa avun saamiseksi.</p>
    </div>
  </header>
     <?php foreach ($books as $book): ?>
            <div class="book">
                <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Ilmainen</h4>
                </div>
                <p>Kirjailija: <?php echo htmlspecialchars($book['author']); ?></p>
                <p>Nimi: <?php echo htmlspecialchars($book['title']); ?></p>
                <p>Kategoria: <?php echo htmlspecialchars($book['category']); ?></p>
                <p>Vuosi: <?php echo htmlspecialchars($book['year']); ?></p>
                <p>ISBN: <?php echo htmlspecialchars($book['isbn']); ?></p>
                <p>Määrä: <?php echo htmlspecialchars($book['quantity']); ?></p>
                <form action="borrow.php" method="post">
                    <input type="hidden" name="book_id" value="<?php echo $book['isbn']; ?>">
                    <button type="submit" name="borrow_book" class="w-100 btn btn-lg btn-outline-primary">Borrow</button>
                </form>
            </div>
        </div>
        </div>
 <?php endforeach; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit();
}
?>

<?php echo $_SESSION['username']; ?>