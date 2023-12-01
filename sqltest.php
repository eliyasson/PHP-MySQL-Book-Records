<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="sqltest.php" method="post">
        <label for="">Enter quantity:</label><br>
        <input type="text" name="quantity"></label><br>
        <input type="submit" value="Calculate total">
        
    </form>
    
</body>
</html>

<?php
   $item= "pizza";
   $price= 5.99;
   $quantity = $_POST["quantity"];
   $total = $quantity * $price;

   echo "One {$item} price is: {$price} <br>";
   echo "You have ordered {$quantity} x {$item}/s <br>";
   echo "Your total is: \${$total}";

?>