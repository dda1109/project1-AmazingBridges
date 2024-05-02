<?php
require_once('../lib/database.php');
require_once('../lib/initialize.php');
$thisPage = 'About';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="mainStyle.css">
</head>

<body>
  <?php include_once('nav.php') ?>
  <div class="container content">
    <div class="about">
      <h2 class="h3-category mb-5">About us</h2>
      <h2 style="text-align:center">Team 3</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="https://st.quantrimang.com/photos/image/072015/22/avatar.jpg" alt="" style="width:100%">
            <div class="container px-3 pt-3">
              <h2>Thu Anh Dang</h2>
              <p class="title">Admin</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="https://st.quantrimang.com/photos/image/072015/22/avatar.jpg" alt="Mike" style="width:100%">
            <div class="container px-3 pt-3">
              <h2>Xuan Chinh Tran</h2>
              <p class="title">Leader</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="https://st.quantrimang.com/photos/image/072015/22/avatar.jpg" alt="John" style="width:100%">
            <div class="container px-3 pt-3">
              <h2>Duc Anh Duong</h2>
              <p class="title">Admin</p>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <br><br>
    <div class="contact">
      <h2 class="h3-category mb-5">Contact Us</h2>
      <p>Please do not hesitate to contact us with any questions you may have.</p>
      <p>Be as precise as possible.</p>
      <p>Use the "amazingbridge.com" as Email Title.</p>
      <p>theamazingbridge.com</p>
    </div>
  </div>

  <?php include('footer.php') ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
</body>

</html>