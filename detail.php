<?php 

session_start();
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'db_mycake');
$id = $_GET["id"];
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM cake_tbl INNER JOIN category_tbl ON cake_tbl.category_id = category_tbl.id WHERE cake_tbl.id=$id";
$result = mysqli_query($conn, $query);
$cake = mysqli_fetch_assoc($result);
$cake_id = $cake['id'];


// insert data 

if (isset($_POST['submit'])) {
  if (is_null($user_id)) {
    echo "<script> alert('login dulu bos') </script>";
  } else {
    $total = $_POST['quantity'];
    $date = date('d-m-y');
    $price_total = $cake["cake_price"] * $total;
    

    $result_transaction = mysqli_query($conn, "SELECT * FROM transaction_tbl WHERE user_id = $user_id");
    $transaction = mysqli_fetch_assoc($result_transaction);
    $transaction_user = $transaction['user_id'];
    $transaction_id = $transaction['id'];
    $new_price_total = $transaction['total'] + $price_total;
    

    if ($transaction_user == $user_id) {
        mysqli_query($conn, "UPDATE transaction_tbl 
            SET total = '$new_price_total' 
            WHERE id = $transaction_id
            ");
    } else {
         mysqli_query($conn, "INSERT INTO transaction_tbl
             VALUES 
                ('', '$user_id', '$date', '$price_total')");
    }

    $new = mysqli_query($conn, "SELECT * FROM transaction_tbl WHERE user_id = $user_id");
    $newdata = mysqli_fetch_assoc($new);
    $new_trans_id = $newdata['id'];
    mysqli_query($conn, "INSERT INTO transaction_detail_tbl
                    VALUES
                    ('', '$new_trans_id', '$id', '$total', '$price_total', 'PENDING')");

    if (mysqli_affected_rows($conn) > 0) {
      echo "<script> alert('succes add to cart') </script>";
    } else echo "<script> alert('failed add to cart') </script>";
  }
}

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- icon -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>My Cake</title>
  </head>
  <body>
    <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">MyCake</a>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="cart.php">Cart</a>
          <a class="dropdown-item" href="checkout.php">Checkout</a>
          <div class="dropdown-divider"></div>
          <?php if ($user_id): ?>
            <a class="dropdown-item" href="logout.php">Logout</a>
          <?php else: ?>
            <a class="dropdown-item" href="login.php">Login</a>
          <?php endif ?>
        </div>
      </li>
      </div>
    </nav>

    <section class="detail">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <img src="img/<?= $cake["cake_photo"]; ?>.jpeg">
          </div>
          <div class="col-md-7 d-flex flex-column justify-content-center">
            <h3><?= $cake["cake_name"] ?></h3>
            <p class="category"><?= $cake["category_name"] ?></p>
            <p class="price">Rp. <?= number_format($cake["cake_price"]); ?></p>
            <p class="desc"><?= $cake["cake_desc"] ?></p>

            <form action="" method="post">
              <input type="number" name="quantity" class="input-quantity" placeholder="quantity">
              <button type="submit" name="submit" class="btn btn-primary btn-add">Add To Cart!</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <footer class="section-footer mt-5 mb-4 border-top">
        <div class="container pt-5 pb-5">
          <div class="row justify-content-center">
              <div class="col-12">
                <div class="row">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-lg-6">
                        <h5>MyCake Shoop</h5>
                        <p class="mt-3">Lorem ipsum dolor sit amet, consectetur <br>adipisicing elit, sed do eiusmod tempor incididunt ut <br>labore et dolore magna aliqua.</p>
                        <i class='bx bxs-facebook mr-3'></i>
                        <i class='bx bxs-instagram mr-3'></i>
                      </div>
                      
                      <div class="col-12 col-lg-3">
                        <h5>Work Time</h5>
                        <ul class="list-unstyled">
                          <li>Every Day: </li>
                          <li>14.00am - 22.00pm</li>
                        </ul>
                      </div>
                      <div class="col-12 col-lg-3">
                        <h5>Contact Info</h5>
                        <ul class="list-unstyled">
                          <li>Bandung, West-Java</li>
                          <li>Indonesia</li>
                          <li>+62 82-222-343-987</li>
                          <li>MyCake@Shoop.com</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row border-top justify-content-center align-items-center pt-4 ">
            <div class="col-auto text-gray-500 font-weight-light">
                2021 Copyright MyCake Shoop • All rights reserved 
            </div>
          </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="script/sweetalert2.all.min.js"></script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>