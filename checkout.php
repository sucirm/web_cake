<?php 

session_start();
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'db_mycake');
$id = $_SESSION['user_id'];

if (is_null($id)) {
  header("location: login.php");
  } else {
    $result = mysqli_query($conn, "SELECT * FROM transaction_tbl WHERE user_id=$id");
    $transaction = mysqli_fetch_assoc($result);
    $transaction_id = $transaction['id'];


    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
    $checkouts = [];
    while ($checkout = mysqli_fetch_assoc($result)) {
        $checkouts[] = $checkout;
    }
    $transaction_id = $checkouts['0']['transaction_id'];

    $result = mysqli_query($conn, "SELECT * FROM user_tbl WHERE id=$id");
    $user = mysqli_fetch_assoc($result);

    $result = mysqli_query($conn, "SELECT SUM(price_total) AS total FROM transaction_detail_tbl WHERE status='CHECKOUT'");
    $total = mysqli_fetch_assoc($result);

    if (isset($_POST['submit'])) {
      if (count($checkouts) == 0) {
        echo "<script> alert('ups, nothing to checkout!') </script>";
      } else {
        mysqli_query($conn, "UPDATE transaction_detail_tbl SET status = 'SUCCES' WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
        if (mysqli_affected_rows($conn) > 0) {
          echo "<script> alert('succes to confirm. your order we will processed!') </script>";
        } else echo "<script> alert('failed to confirm') </script>";
      }
    }

    if (isset($_POST['cancel'])) {
      if (count($checkouts) == 0) {
        echo "<script> alert('ups, nothing to cancel') </script>";
      } else {
        mysqli_query($conn, "UPDATE transaction_detail_tbl SET status = 'PENDING' WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
        if (mysqli_affected_rows($conn) > 0) {
          echo "<script> alert('succes to cancel, thank you!') </script>";
        } else echo "<script> alert('failed to cancel') </script>";
      }
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
          <?php if ($id): ?>
            <a class="dropdown-item" href="logout.php">Logout</a>
          <?php else: ?>
            <a class="dropdown-item" href="login.php">Login</a>
          <?php endif ?>
        </div>
      </li>
      </div>
    </nav>

    <section class="checkout">
      <div class="container">
        <div class="row">
            <div class="col-lg-8">
              <div class="card card-checkout-details mb-3">
                <h3>Checkout Info</h3>
                <?php if (count($checkouts) == 0): ?>
                  <div class="alert alert-danger" role="alert">
                    ups, please checkout in <a href="cart.php">cart page</a> firt.
                  </div>
                <?php endif ?>
                <div class="attendee">
                  <table class="table table-responsive-sm text-center">
                    <thead>
                      <tr>
                        <td scope="col" class="align-middle text-left">Name</td>
                        <td scope="col" class="align-middle">Quantity</td>
                        <td scope="col" class="align-middle text-right">Price</td>
                        <td scope="col" class="align-middle text-right">Total</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($checkouts as $data): ?>
                        <tr>
                          <td class="align-middle text-left"><?= $data['cake_name'] ?></td>
                          <td class="align-middle"><?= $data['quantity'] ?></td>
                          <td class="align-middle text-right">Rp. <?= number_format($data['cake_price']); ?></td>
                          <td class="align-middle text-right">Rp. <?= number_format($data['price_total']); ?></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>

                <hr>
                <h3>Order Info</h3>
                <?php if ($user['phone'] == NULL or $user['name'] == NULL or $user['address'] == NULL): ?>
                  <div class="alert alert-danger" role="alert">
                    ups, please complete your profile in <a href="profile.php">profile page</a>.
                  </div>
                <?php endif ?>
                <div class="attendee">
                  <table class="table table-responsive-sm">
                    <thead>
                      <tr>
                        <td scope="col" class="align-midle text-left">Name</td>
                        <td scope="col" class="align-midle text-left">Address</td>
                        <td scope="col" class="align-midle text-left">Phone Number</td>
                        <td scope="col" class="align-midle text-left">Email</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="align-middle text-left"><?= $user['name'] ?></td>
                        <td class="align-middle text-left"><?= $user['address'] ?></td>
                        <td class="align-middle text-left"><?= $user['phone'] ?></td>
                        <td class="align-middle text-left"><?= $user['email'] ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>



            <div class="col-lg-4">
              <div class="card card-payment-details card-right">
                <h2>Payment Info</h2>
                <p>payment total : Rp. <?= number_format($total["total"]); ?></p>
                <hr />
                <h2>Payment Instructions</h2>
                <p class="payment-instructions">
                  Please complete your payment first, after that you can clik the confirm button to confirm your transaction.
                </p>
                <hr>
                <div class="bank">
                  <div class="bank-item pb-3">
                    <div class="description">
                      <h2>MyCake Shoop</h2>
                      <p>
                        0661 6612 1289
                        <br />
                        Bank Central Asia
                      </p>
                    </div>
                    
                  </div>
                </div>
                <hr>
                <form action="" method="post" class="d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn btn-primary">confirm</button>
                </form>
              </div>
              <form action="" method="post">
                <div class="text-center mt-3">
                  <button type="submit" name="cancel" class="btn" onclick="confirm('are you sure to cancel?')">cancel</button>
                </div>
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