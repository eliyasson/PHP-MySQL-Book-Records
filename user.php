 
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


$query = "SELECT * FROM books";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    // Handle error in the query preparation
    echo "Query preparation error: " . $conn->error;
    exit();
}
$stmt->execute();
$result = $stmt->get_result();
$books = [];
while ($row = $result->fetch_assoc()) {
        $books[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Käyttäjäsivu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
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
            margin: 5px 0;
        }
        form {
            display: inline;
        }

        button[name="borrow_book"] {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button[name="borrow_book"]:hover {
            background-color: #0056b3;
        }
         h1, h2 {
            color: #333;
        }

        a {
            background-color: #007bff;;
            margin-bottom: 10px;
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: black;
        }
        .welcome {
            text-align: center;
            margin-bottom: 20px;
        }
.overview {
            margin-bottom: 20px;
        }
        .navigation {
            text-align: center;
            margin-bottom: 20px;
        }
        .navigation a {
            margin: 0 10px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .navigation a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="welcome">
        <h1>Tervetuloa Kyläkirjastoon</h1>
        <p>Tutustu kirja- ja laitekokoelmiimme sekä keskustele kanssamme chatin kautta avun saamise$
    </div>

    <div class="overview">
        <h2>Kirjaston Palvelut Yleiskatsaus:</h2>
        <p>Täällä voit nähdä saatavilla olevat kirjat, lainata laitteita ja keskustella kirjaston h$
    </div>

    <div class="navigation">
        <h2>Navigointivalikko:</h2>
        <a href="user.php">Kirjalistaus</a>
        <a href="#">Laitteiden Lainaus</a>
        <a href="chat.php">Chat</a>
    </div>


    <?php foreach ($books as $book): ?>
        <div class="book">
            <p>Kirjailija: <?php echo htmlspecialchars($book['author']); ?></p>
            <p>Nimi: <?php echo htmlspecialchars($book['title']); ?></p>
            <p>Kategoria: <?php echo htmlspecialchars($book['category']); ?></p>
            <p>Vuosi: <?php echo htmlspecialchars($book['year']); ?></p>
            <p>ISBN: <?php echo htmlspecialchars($book['isbn']); ?></p>
            <p>Määrä: <?php echo htmlspecialchars($book['quantity']); ?></p>
          <form action="borrow.php" method="post">
            <input type="hidden" name="book_id" value="<?php echo $book['isbn']; ?>">
            <button type="submit" name="borrow_book">Borrow</button>
        </form>
        </div>
    <?php endforeach; ?>
</body>
</html>

<form action="logout.php" method="post">
        <input type="submit" style="background-color: red" value="Logout">
    </form>

