
<?php
session_start();
require_once 'config.php';

// add, remove, empty.
if (!empty($_GET['action'])) {
    switch ($_GET['action']) {
        // add product to cart
        case 'add':
            if (!empty($_POST['quantity'])) {
                $pid = $_GET['pid'];
                $query = "SELECT * FROM products WHERE id=" . $pid;
                $result = mysqli_query($conn, $query);
                while ($product = mysqli_fetch_array($result)) {
                    $itemArray = [
                        $product['code'] => [
                            'name' => $product['name'],
                            'code' => $product['code'],
                            'quantity' => $_POST['quantity'],
                            'price' => $product['price'],
                            'image' => $product['image']
                        ]
                    ];
                    if (isset($_SESSION['cart_item']) &&!empty($_SESSION['cart_item'])) {
                        if (in_array($product['code'], array_keys($_SESSION['cart_item']))) {
                            foreach ($_SESSION['cart_item'] as $key => $value) {
                                if ($product['code'] == $key) {
                                    if (empty($_SESSION['cart_item'][$key]["quantity"])) {
                                        $_SESSION['cart_item'][$key]['quantity'] = 0;
                                    }
                                    $_SESSION['cart_item'][$key]['quantity'] += $_POST['quantity'];
                                }
                            }
                        } else {
                            $_SESSION['cart_item'] += $itemArray;
                        }
                    } else {
                        $_SESSION['cart_item'] = $itemArray;
                    }
                }
            }
            break;
            // removecode
        case 'remove':
            if (!empty($_SESSION['cart_item'])) {
                foreach ($_SESSION['cart_item'] as $key => $value) {
                    if ($_GET['code'] == $key) {
                        unset($_SESSION['cart_item'][$key]);
                    }
                    if (empty($_SESSION['cart_item'])) {
                        unset($_SESSION['cart_item']);
                    }
                }
            }
            break;
        case 'empty':
            unset($_SESSION['cart_item']);
            break;
    }
}

if (isset( $_POST['snoEdit'])){
// Update the record
  $name = $_POST["sellernameEdit"];
  $phone = $_POST["sellerphoneEdit"];
  $address = $_POST["selleraddressEdit"];

// Sql query to be executed
$deliverd = "delivered";
$sql = "UPDATE `delivery` SET `status` = 'delivered' WHERE `delivery`.`id` = $phone";
$result = mysqli_query($conn, $sql);
if($result){
  $update = true;
}
else{
  echo "We could not update the record successfully";
}
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/order.css">
</head>
<body>

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

      <li class="nav-item">
        <a class="nav-link" href="sellers.php">Sellers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">Users</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="order.php">Delivery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>



    </ul>




  </div>
</nav>

<div class="container py-5">
    <div class="d-flex justify-content-between mb-2">
        <h3>Cart</h3>
        <a class="btn btn-success" href="order.php?action=empty">All Item Remove</a>
    </div>
    <div class="row">
        <?php
            $total_quantity = 0;
            $total_price = 0;

        ?>
        <table class="table">
            <tbody>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Code</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Item Price</th>
                <th class="text-right">Price</th>
                <th class="text-center">Remove</th>
            </tr>
            <?php
            if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])){
                foreach ($_SESSION['cart_item'] as $item) {
                    $item_price = $item['quantity'] * $item['price'];
                    ?>
                    <tr>
                        <td class="text-left">
                            <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" width="100">
                            <?= $item['name'] ?>
                        </td>
                        <td class="text-left"><?= $item['code'] ?></td>
                        <td class="text-right"><?= $item['quantity'] ?></td>
                        <td class="text-right">BDT <?= number_format($item['price'], 2) ?></td>
                        <td class="text-right">BDT <?= number_format($item_price, 2) ?></td>
                        <td class="text-center">
                            <a href="order.php?action=remove&code=<?= $item['code']; ?>" class="btn btn-danger">X</a>
                        </td>
                    </tr>

                    <?php
                    $total_quantity += $item["quantity"];
                    $total_price += ($item["price"]*$item["quantity"]);


                }
            }



            if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])){
                ?>
                <tr>
                    <td colspan="2" align="right">Total:</td>
                    <td align="right"><strong><?= $total_quantity ?></strong></td>
                    <td></td>
                    <td align="right"><strong>BDT <?= number_format($total_price, 2); ?></strong></td>
                    <td></td>
                </tr>

            <?php }

                ?>
            </tbody>
        </table>

    </div>

    <!-- order -->
    <form action="/login/delivery.php" method="post">
    <div class="d-flex justify-content-center mb-2">
        <a class="btn btn-danger" name="order" id="order" href="order.php?action=empty">ORDER</a>
    </div>
  </form>
<?php

if ($_SERVER['REQUEST_METHOD']== 'POST'){

  $price = $total_price;
  $status = "shipping";
$sql = "INSERT INTO `delivery` (`price`,`status`) VALUES ('$price','$status')";
$result = mysqli_query($conn,$sql);

if($result)
{
  $insert=true;
}
else {
echo "the record was not inserted because:". mysqli_error($conn);}
}
 ?>

    <!-- first done this -->
    <div class="row">
        <div class="col-md-12">
            <h1>Products List</h1>
            <div class="d-flex">
                <div class="card-deck">
                    <?php
                    $query = "SELECT * FROM products";
                    $product = mysqli_query($conn, $query);
                    if (!empty($product)) {
                        while ($row = mysqli_fetch_array($product)) { ?>
                            <form action="order.php?action=add&pid=<?= $row['id']; ?>" method="post">
                                <div class="card" style="width:18rem">
                                    <img class="card-img-top"
                                         src="<?= $row['image']; ?>"
                                         alt="<?= $row['name']; ?>"
                                         width="150">
                                    <div class="card-header d-flex justify-content-between">
                                        <span><?= $row['name']; ?></span>
                                        <span>BDT <?= number_format($row['price'], 2); ?></span>
                                    </div>
                                    <div class="card-body d-flex justify-content-between">
                                        <input type="text" name="quantity" value="1" size="2">
                                        <input type="submit" value="Add to Cart" class="btn btn-primary btn-sm">
                                    </div>
                                </div>
                            </form>
                        <?php }
                    } else {
                        echo "no products available";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- test -->
    <div class="container my-4">
      <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Order No</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>


            </tr>
          </thead>
          <tbody>

      <h3>Order</h3>
      <?php
        $sql = "SELECT * FROM `delivery`";
        $result = mysqli_query($conn,$sql);
        $sno = 0;
        if($result){
              while($row = mysqli_fetch_assoc($result)){
                $sno = $sno + 1;
                echo "<tr>
              <th scope='row'>". $sno . "</th>
                <td>". $row['price'] . "</td>
                <td>". $row['status'] . "</td>
              </tr>";
            }

          }
          else
          {
            echo "result var is not true";
          }
       ?>
  </div>



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


</body>
</html>
