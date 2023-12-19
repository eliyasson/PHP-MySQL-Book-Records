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
<html>
<head>
    <title>Welcome to Village Library</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="bg-dark text-secondary px-4 py-5 text-center">
        <div class="py-5">
          <h1 class="display-5 fw-bold text-white">Tervetuloa <?php echo $_SESSION['username']; ?> Kyläkirjastoon</h1>
            <div class="col-lg-6 mx-auto">
                <p class="fs-5 mb-4">Oletko kirjastonhoitaja vai käyttäjä? Valitse alla:</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="home.php?role=librarian" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Kirjastonhoitaja</a>
                    <a href="user.php?role=user" class="btn btn-outline-light btn-lg px-4">Käyttäjä</a>
                </div>
            </div>
        </div>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

