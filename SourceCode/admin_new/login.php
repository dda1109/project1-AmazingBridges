<?php
require_once('../lib/database.php');
require_once('../lib/initialize.php');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  checkFormLogin();
  if (isFormValidated()) {
    $_SESSION['user'] = $_POST['name'];
    redirect_to('indexBridge.php');
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      background-color: #e4e5e6;
    }

    .container>.row {
      background-color: white;
      flex-basis: 60%;
      justify-content: center;
      padding-top: 50px;
      padding-bottom: 50px;
      border: 1px solid #bdbdbd;
    }
  </style>
</head>

<body>
  <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="row">
      <div class="col-md-10">
        <h1 class="text-center mb-4">Login</h1>
        <form action="" method="post">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="fa fa-user"></i>
              </span>
            </div>
            <input type="text" name="name" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo isFormValidated() ? '' : $_POST['name'] ?>">
          </div>
          <?php if (!empty($errors['name'])) : ?>
            <div class="text-danger mb-3">
              <?php echo $errors['name']; ?>
            </div>
          <?php endif ?>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="fa fa-lock"></i>
              </span>
            </div>
            <input type="password" name="pwd" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <?php if (!empty($errors['pwd'])) : ?>
            <div class="text-danger mb-3">
              <?php echo $errors['pwd']; ?>
            </div>
          <?php endif ?>
          <input type="checkbox" class="mb-4"><small>Remember me</small>
          <div class="row justify-content-between">
            <div class="col-md-8">
              <input class="btn btn-primary px-3" type="submit" value="Login">
            </div>
            <br>
            <div class="col-md-4">
              <a href="#">
                <p>Forget Password ?</pathinfo>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>