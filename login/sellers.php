
<?php
$insert = false;
$update = false;
$delete = false;

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
// Connect to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

// Create a new connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
// delete

if(isset($_GET['delete'])){
  $phone = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `sellers` WHERE `sellers`.`phone` = $phone";
  $result = mysqli_query($conn, $sql);
}
// insert

if ($_SERVER['REQUEST_METHOD']== 'POST'){
  if (isset( $_POST['snoEdit'])){
  // Update the record
    $name = $_POST["sellernameEdit"];
    $phone = $_POST["sellerphoneEdit"];
    $address = $_POST["selleraddressEdit"];

  // Sql query to be executed
  $sql = "UPDATE `sellers` SET `name` = '$name' , `phone` = '$phone' , `address` = '$address' WHERE `sellers`.`phone` = $phone";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}

  else{
  $name = $_POST["sellername"];
  $phone = $_POST["sellerphone"];
  $address = $_POST["selleraddress"];

  // sql query to be executed
  $sql = "INSERT INTO `sellers` (`name`,`phone`,`address`) VALUES ('$name','$phone','$address')";
  $result = mysqli_query($conn,$sql);

  if($result)
  {
    $insert=true;
  }
  else {
  echo "the record was not inserted because:". mysqli_error($conn);}
}
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS & datatables.net css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>P2P Delivery System</title>


  </head>
  <body>
    <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Edit information for this phone number</h5>
        <form action="/login/sellers.php" method="post">
          <input type="hidden" name="snoEdit" id="snoEdit" >
        <div class="mb-3">
          <label for="sellername" class="form-label">Seller Name</label>
          <input type="text" class="form-control" id="sellernameEdit" name="sellernameEdit" aria-describedby="emailHelp" placeholder="enter name" required>
        </div>
        <div class="mb-3">

          <input type="hidden" class="form-control" id="sellerphoneEdit" name="sellerphoneEdit" placeholder="enter phone number" required>
        </div>
        <div class="form-floating">
          <label for="selleraddress">Address</label>
        <textarea class="form-control" placeholder="Type your address" id="selleraddressEdit" name="selleraddressEdit" required></textarea>
      </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
 <!-- Navbar starts  -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <a class="navbar-brand" href="#">P2P Delivery System</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarNavDropdown">
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>
     </li>
     <li class="nav-item active">
       <a class="nav-link" href="sellers.php">Sellers</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="users.php">Users</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="order.php">Delivery</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="logout.php">Logout</a>
     </li>



   </ul>

 <div class="navbar-collapse collapse">
 <ul class="navbar-nav ml-auto">
 <li class="nav-item active">
       <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome ". $_SESSION['username']?></a>
     </li>
 </ul>
 </div>


 </div>
</nav>
  <!-- alert button -->
  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your record has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your record has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
<!-- form -->
<div class="container my-4">
  <h2>Apply as a Seller</h2>
  <p>Please fill up the info</p>
  <form action="/login/sellers.php" method="post">
  <div class="mb-3">
    <label for="sellername" class="form-label">Seller Name</label>
    <input type="text" class="form-control" id="sellername" name="sellername" aria-describedby="emailHelp" placeholder="enter name" required>
  </div>
  <div class="mb-3">
    <label for="sellerphone" class="form-label">Phone Number</label>
    <input type="tel" class="form-control" id="sellerphone" name="sellerphone" placeholder="enter phone number" required>
  </div>
  <div class="form-floating">
    <label for="selleraddress">Address</label>
  <textarea class="form-control" placeholder="Type your address" id="selleraddress" name="selleraddress" required></textarea>
</div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<!-- form ends -->
<div class="container my-4">
  <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
  <?php
    $sql = "SELECT * FROM `sellers`";
    $result = mysqli_query($conn,$sql);
    $sno = 0;
    if($result){
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
          <th scope='row'>". $sno . "</th>
            <td>". $row['name'] . "</td>
            <td>". $row['phone'] . "</td>
            <td>". $row['address'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary'id=".$row['phone'].">Edit</button> <button class='delete btn btn-sm btn-danger'id=d".$row['phone'].">Delete</button> </td>
          </tr>";
        }

      }
      else
      {
        echo "result var is not true";
      }
   ?>
 </tbody>
 </table>
<hr>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS, then datatables.net -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
  edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{
    element.addEventListener("click", (e)=>{
      console.log("edit ");
      tr = e.target.parentNode.parentNode;
         name = tr.getElementsByTagName("td")[0].innerText;
        phone= tr.getElementsByTagName("td")[1].innerText;
        address = tr.getElementsByTagName("td")[2].innerText;
        console.log(name, phone, address);
        sellernameEdit.value = name;
        sellerphoneEdit.value = phone;
        selleraddressEdit.value = address;
        snoEdit.value = e.target.id;
         console.log(e.target.id)
        $('#editModal').modal('toggle');
    })
  })

  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
    element.addEventListener("click", (e)=>{
      console.log("delete ");
      phone = e.target.id.substr(1);

           if (confirm("Are you sure you want to delete this record!")) {
             console.log("yes");
             window.location = `/login/sellers.php?delete=${phone}`;
             // TODO: Create a form and use post request to submit a form
           }
           else {
             console.log("no");
           }
    })
  })
  </script>
  </body>
</html>
