<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken";
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password.
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Page</title>
  </head>
  <body>
    <div class="container">
      <div class="row w-100 d-flex justify-content-center align-items-center main_div">
        <div class="col-12 col-md-8 col-xxl-5">
          <!-- CARD -->
          <div class="card py-3 px-2">
            <p class="text-center my-3 text-capitalize text-white"><span style="font-size:1.2em;">Connect with us</span></p>
            <!-- Social Icons -->
            <div class="row mx-auto">
              <!-- instagram -->
              <div class="col-4">
                  <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram fa-2x" style="color:white"></i></a>
              </div>
              <!-- facebook -->
              <div class="col-4">
                  <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook fa-2x" style="color:white"></i></a>
              </div>
              <!-- twitter -->
              <div class="col-4">
                  <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter fa-2x" style="color:white"></i></a>
              </div>
              <!-- Social Icons End --> </div>
              <div class="login_div">
                <div class="row my-3">
                  <div class="col-6 mx-auto">
                    <span class="main_heading text-white"><p class="text-center" style="font-size:1.2em;">REGISTRATION</p></span>
                  </div>
                </div>
                <!-- form  -->
                <form class="text-white" action="" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone</label>
    <input type="tel" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Number">
    <div id="emailHelp" class="form-text text-white">We'll never share your phone number with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Type Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword2" placeholder="Password">
  </div>
  <div class="my-3 d-grid gap-5">
    <button type="submit" class="btn btn-primary btn-block btn-lg">
      <small><i class="far fa-user pr-2"></i> Create Account</small>
    </button>
  </div>
  <div class="col-12">
    <p class="text-center">Registered? Go back to <a class="text-white" href="login.php">Login Page</a></p>
    <p class="text-center">Go Back to <a class="text-white" href="index.php">Home</a></p>
  </div>

</form>
              </div>
          </div>
        </div>
      </div>
    </div>


    <!--  Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  </body>
</html>
