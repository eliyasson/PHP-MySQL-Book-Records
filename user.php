<!-- 
?php
/* session_start();
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
?> -->

<!DOCTYPE html>
<html>
<head>
        <title>Käyttäjäsivu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

        }
        .book p {
            margin: 5px 0;
        }
        </style>
</head>
<body>
        <?php foreach ($books as $book): ?>
         
            <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Sign up for free</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" fdprocessedid="yptvcc"></button>
      </div>

      <div class="modal-body p-5 pt-0">
        <form class="">
          <div class="form-floating mb-3">
            <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" fdprocessedid="dy29lk">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" fdprocessedid="fqch9">
            <label for="floatingPassword">Password</label>
          </div>
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" fdprocessedid="jmae6a">Sign up</button>
          <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
          <hr class="my-4">
          <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
          <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit" fdprocessedid="1hfczx">
            <svg class="bi me-1" width="16" height="16"><use xlink:href="#twitter"></use></svg>
            Sign up with Twitter
          </button>
          <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit" fdprocessedid="e7wrx4">
            <svg class="bi me-1" width="16" height="16"><use xlink:href="#facebook"></use></svg>
            Sign up with Facebook
          </button>
          <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit" fdprocessedid="r0p1">
            <svg class="bi me-1" width="16" height="16"><use xlink:href="#github"></use></svg>
            Sign up with GitHub
          </button>
        </form>
      </div>
    </div>
  </div>
</div>





        <!-- <div class="book">
            <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
            <p>Title: <?php echo htmlspecialchars($book['title']); ?></p>
            <p>Category: <?php echo htmlspecialchars($book['catagory']); ?></p>
            <p>Year: <?php echo htmlspecialchars($book['year']); ?></p>
            <p>ISBN: <?php echo htmlspecialchars($book['isbn']); ?></p>
            <p>Quantity: <?php echo htmlspecialchars($book['quantity']); ?>
            </p>
        </div> -->
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
</body>
</html>



