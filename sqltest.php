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
   $foods = array("apple", "orange", "banana", "coconut");

   /* foreach($foods as $food) {
    echo $food . "<br>";
   } */

   for ($i = 0; $i < count($foods); $i++) {
    echo $foods[$i] . "<br>";
   }

?>