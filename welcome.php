<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Village Library</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-dark text-secondary px-4 py-5 text-center">
        <div class="py-5">
            <h1 class="display-5 fw-bold text-white">Tervetuloa Kyläkirjastoon</h1>
            <div class="col-lg-6 mx-auto">
                <p class="fs-5 mb-4">Are you a librarian or user? Please select below:</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="welcome.php?role=librarian" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Librarian</a>
                    <a href="welcome.php?role=user" class="btn btn-outline-light btn-lg px-4">User</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Your other content -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
