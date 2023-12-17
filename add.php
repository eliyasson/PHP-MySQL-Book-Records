<!DOCTYPE html>
<html>
<head>
    <title>Book Records</title>
    <link rel="stylesheet" href="tyylit2.css">
</head>
<body>
<?php //dqltest.php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal connection Error");
if (isset($_POST['delete']) && isset($_POST['isbn']))
{
$isbn = get_post($conn, 'isbn');
$query = "DELETE FROM books WHERE  isbn='$isbn'";
$result = $conn->query($query);
if (!$result) echo "DELETE failed<br><br>";
}
if(
	isset($_POST['author']) &&
	isset($_POST['title']) &&
	isset($_POST['category']) &&
	isset($_POST['year']) &&
	isset($_POST['isbn']))
 {
$author = get_post($conn, 'author');
$title = get_post($conn, 'title');
$category = get_post($conn, 'category');
$year = get_post($conn, 'year');
$isbn = get_post($conn, 'isbn');
$query = "INSERT INTO books VALUES ('$author', '$title', '$category', '$year', '$isbn')";
$result = $conn->query($query);
if (!$result) echo "INSERT failed<br><br>";

}
echo <<<_END
<form action="add.php" method="post"><pre>
Author:		<input type="text" name="author">
Title:		<input type="text" name="title">
Category:	<input type="text" name="category">
Year:		<input type="text" name="year">
ISBN:		<input type="text" name="isbn">
<input type="submit"  value="ADD RECORD">
</pre></form>
_END;
$query="SELECT * FROM books";
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
    echo <<<_END
        <div class="records">
	<div class="record">
            <p>Author: $r0</p>
            <p>Title: $r1</p>
            <p>Category: $r2</p>
            <p>Year: $r3</p>
            <p>ISBN: $r4</p>
	<div class="button-group">
            <form action='add.php' method='post'>
                <input type='hidden' name='delete' value='yes'>
                <input type='hidden' name='isbn' value='$r4'>
                <input class='delete-btn' type='submit' value='DELETE RECORD'>
            </form>

	   <form action='update.php' method='post'>
                <input type='hidden' name='update' value='yes'>
                <input type='hidden' name='isbn' value='$r4'>
                <input class='update-btn' type='submit' value='UPDATE'>
            </form>
	</div>
	</div>

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

