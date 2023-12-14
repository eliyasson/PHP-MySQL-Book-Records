
<!DOCTYPE html>
<html>
<head>
    <title>Book Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        input[type="text"], input[type="submit"] {
            width: 50%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        .record {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }  .record p {
            margin: 5px 0;
        }
        .delete-btn {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 2px 5px;
            border-radius: 3px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }

    </style>
</head>
<body>

<?php //dqltest.php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal connection Error");
if (isset($_POST['delete']) && isset($_POST['isbn']))
{
$isbn = get_post($conn, 'isbn');
$query = "DELETE FROM classics WHERE  isbn='$isbn'";
$result = $conn->query($query);
if (!$result) echo "DELETE failed<br><br>";
}
if(
        isset($_POST['author']) &&
        isset($_POST['title']) &&
        isset($_POST['catagory']) &&
        isset($_POST['year']) &&
        isset($_POST['isbn']) &&
        isset($_POST['quantity']))
 {
$author = get_post($conn, 'author');
$title = get_post($conn, 'title');
$category = get_post($conn, 'catagory');
$year = get_post($conn, 'year');
$isbn = get_post($conn, 'isbn');
$quantity = get_post($conn, 'quantity');

$query = "INSERT INTO books VALUES ('$author', '$title', '$catagory', '$year', '$isbn', $quantity)";
$result = $conn->query($query);
if (!$result) echo "INSERT failed<br><br>";

}

echo <<<_END
<form action="home.php" method="post">
    <pre>
        Author:    <input type="text" name="author">
        Title:     <input type="text" name="title">
        Category:  <input type="text" name="catagory">
        Year:      <input type="text" name="year">
        ISBN:      <input type="text" name="isbn">
        Quantity:  <input type="text" name="quantity">
        <input type="submit" value="ADD RECORD">
    </pre>
</form>
_END;
$query="SELECT * FROM classics";
$result=$conn->query($query);
if (!$result) die ("Database access failed");

$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);
    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);
    $r4 = htmlspecialchars($row[4]);
    $r5 = htmlspecialchars($row[5]);

    echo <<<_END
        <div class="record">
            <p>Author: $r0</p>
            <p>Title: $r1</p>
            <p>Category: $r2</p>
            <p>Year: $r3</p>
            <p>ISBN: $r4</p>
            <p>Quantity: $r5</p>
            <form action='sqltest.php' method='post'>
                <input type='hidden' name='delete' value='yes'>
                <input type='hidden' name='isbn' value='$r4'>
                <input class='delete-btn' type='submit' value='DELETE RECORD'>
            </form>
            <form action="update.php" method="post">';
                <input type="hidden" name="isbn" value='$r4'>;
                <input class="update-btn" type="submit" value="UPDATE">';
            </form>';
        </div>
_END;
}

$result->close();
$conn->close();
function get_post($conn,$var)
{
return $conn->real_escape_string($_POST[$var]);
}
?>
</body>
</html>
