<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- CDN FILES ADDED -->
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <header>
      <!-- Animated navbar-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-scroll">
      <div class="container">
        <button
                class="navbar-toggler ps-0"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01"
                aria-controls="navbarExample01"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
          <span
                class="navbar-toggler-icon d-flex justify-content-start align-items-center"
                >
            <i class="fas fa-bars"></i>
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item px-3">
              <a class="nav-link link-danger"
                aria-current="page"
                href="#">Home</a>
            </li>
            <li class="nav-item px-3">
              <a
                 class="nav-link link-danger"
                 href="about.html"
                 rel="nofollow"
                 >About</a>

            </li>
            <li class="nav-item px-3">
              <a
                 class="nav-link link-danger"
                 href="login.php"
                 >Login</a>

            </li>
            <li class="nav-item px-3">
              <a
                 class="nav-link link-danger"
                 href="register.php"
                 >Register</a>

            </li>
          </ul>

          <ul class="navbar-nav flex-row">
            <!-- Icons -->

            <li class="nav-item">
              <a
                 class="nav-link px-3"
                 href=""
                 rel="nofollow"
                 target="_blank"
                 >
                <i class="fab fa-instagram fa-2x"></i>
              </a>
            </li>
            <li class="nav-item">
              <a
                 class="nav-link px-3"
                 href=""
                 rel="nofollow"
                 target="_blank"
                 >
                <i class="fab fa-facebook fa-2x"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Animated navbar -->
    <!-- Background image -->
      <div
           id="intro"
           class="bg-image shadow-2-strong"
           style="
                  background-image: url(images/cover1.jpg);
                  height: 100vh;
                  "
           >
        <div class="mask text-white" style="background-color: rgba(0, 0, 0, 0.5)"> <!-- opacity of background -->
          <div class="container d-flex align-items-center text-center h-100">
            <div>
            <div class="cover-text-centered"><h1>P2P Delivery System</h1></div>
            <h2>
  <a href="" class="typewrite" data-period="2000" data-type='[ "Sell Products.", "Easy Delivery.", "Buy Happiness." ]'>
    <span class="wrap"></span>
  </a>
</h2>
            </div>
          </div>
        </div>
      </div>
      <!-- Background image -->
    </header>
    <main>
      
<hr class"my-5" />
<!-- Footer -->
<footer class="bg-dark text-center text-primary">
<!-- Grid container -->
<div class="container p-4">
  <!-- Section: Social media -->
  <section class="mb-4">
    <!-- Facebook -->
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
      ><i class="fab fa-facebook-f"></i
    ></a>

    <!-- Twitter -->
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
      ><i class="fab fa-twitter"></i
    ></a>

    <!-- Google -->
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
      ><i class="fab fa-google"></i
    ></a>

    <!-- Instagram -->
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
      ><i class="fab fa-instagram"></i
    ></a>

    <!-- Linkedin -->
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
      ><i class="fab fa-linkedin-in"></i
    ></a>

    <!-- Github -->
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
      ><i class="fab fa-github"></i
    ></a>
  </section>
  <!-- Section: Social media -->

  <!-- Section: Form -->

        <!--Grid column-->

        <!--Grid column-->
        <div class="col-auto">
          <!-- Submit button -->
          <button type="submit" class="btn btn-outline-light mb-4">
            Subscribe
          </button>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->

<!-- Copyright -->
<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.8);">
  <p class="text-light">&copy; <script>document.write(new Date().getFullYear())</script> Copyright: <a class="text-white" href="">Novojit Das</a></p>

</div>
<!-- Copyright -->

</footer>
<!-- Footer -->

  <!-- JS Link -->
  <script src="effect.js"></script>
  <!-- MDB JS -->
  <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
  ></script>

</body>
</html>
