<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="sqltest.php" method="get">
        <label for="">username:</label>
        <input type="text" name="username"></label>
        <label for="">password:</label>
        <input type="password" name="password"></label>
        <input type="submit" value="Log in">
    </form>
    
</body>
</html>

<?php
    $name = "Eliyas";
    $food = "pizza";
    $email = "eliyasson@gmail.com";

    echo"Hello {$name}<br>";
    echo"I like {$food}<br>";
    echo"Hello {$email}<br>";


?>