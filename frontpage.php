<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="isolation: isolate;">
<header data-bs-theme="dark">
    
    <nav class="navbar-dark fixed-top" style="background-color: rgba(0, 0, 0, 0.5)";>
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Home</a></li>
            <li><a href="#" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Features</a></li>
            <li><a href="#" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Pricing</a></li>
            <li><a href="#" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">FAQs</a></li>
            <li><a href="#" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">About</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2">Login</button>
            <button type="button" class="btn btn-primary">Sign-up</button>
        </div>
        </header>
    </nav>
  
 
  <!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Mysqli Kirjasto</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success form-control me-2" type="submit">Search</button>
          <button class="btn btn-outline-success form-control me-2" type="submit">Search</button>
          <button class="btn btn-outline-success form-control me-2" type="submit">Search</button>
          <button class="btn btn-outline-success form-control me-2" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav> -->
</header>

<main>

  <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
    </div>
    <div class="carousel-inner">
    

      <div class="carousel-item">
      
        <div class="carousel-caption d-none d-md-block text-white text-shadow" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="container">
                <h1 class="display-5 fw-bold">Tervetuloa <?php echo $_SESSION['username']; ?> Kyläkirjastoon</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mb-4">Oletko kirjastonhoitaja vai käyttäjä? Valitse alla:</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="home.php?role=librarian" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Kirjastonhoitaja</a>
                        <a href="user.php?role=user" class="btn btn-outline-light btn-lg px-4">Käyttäjä</a>
                    </div>
                </div>
            </div>
        </div>
      <img src="./kuva/kuva 1.jpg" class="bd-placeholder-img" width="100%" height="700" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        
        <div class="container">
          <div class="carousel-caption text-start">
          </div>
        </div>
      </div>
      <div class="carousel-item">
      <div class="carousel-caption d-none d-md-block text-white text-shadow" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="container">
                <h1 class="display-5 fw-bold">Tervetuloa <?php echo $_SESSION['username']; ?> Kyläkirjastoon</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mb-4">Oletko kirjastonhoitaja vai käyttäjä? Valitse alla:</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="home.php?role=librarian" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Kirjastonhoitaja</a>
                        <a href="user.php?role=user" class="btn btn-outline-light btn-lg px-4">Käyttäjä</a>
                    </div>
                </div>
            </div>
        </div>
      <img src="./kuva/kuva 4.jpg" class="bd-placeholder-img" width="100%" height="700" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        <div class="container">
        
        </div>
      </div>
      <div class="carousel-item active">
      <div class="carousel-caption d-none d-md-block text-white text-shadow" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="container">
                <h1 class="display-5 fw-bold">Tervetuloa <?php echo $_SESSION['username']; ?> Kyläkirjastoon</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mb-4">Oletko kirjastonhoitaja vai käyttäjä? Valitse alla:</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="home.php?role=librarian" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Kirjastonhoitaja</a>
                        <a href="user.php?role=user" class="btn btn-outline-light btn-lg px-4">Käyttäjä</a>
                    </div>
                </div>
            </div>
        </div>
      <img src="./kuva/kuva 3.jpg" class="bd-placeholder-img" width="100%" height="700" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
      <div class="container">
          
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing" style="margin-top: 20px;">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
        <img src="./kuva/kuva 2.jpg" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        <h2 class="fw-normal">Heading</h2>
        <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
        <p><a class="btn btn-secondary" href="#">View details »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img src="./kuva/kuva 3.jpg" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        <h2 class="fw-normal">Heading</h2>
        <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
        <p><a class="btn btn-secondary" href="#">View details »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img src="./kuva/kuva 5.jpg" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        <h2 class="fw-normal">Heading</h2>
        <p>And lastly this, the third column of representative placeholder content.</p>
        <p><a class="btn btn-secondary" href="#">View details »</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

   

    

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


 
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>