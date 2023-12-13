<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Sign in</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" fdprocessedid="yptvcc"></button>
      </div>

      <div class="modal-body p-5 pt-0">
        <form action="signin.php" method="post">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control rounded-3" id="floatingInput" placeholder="Username">
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" fdprocessedid="fqch9">
            <label  for="password">Password</label>
          </div>
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit"  fdprocessedid="jmae6a">Sign Up</button>
          <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
          <hr class="my-4">
          
        </form>
        

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
