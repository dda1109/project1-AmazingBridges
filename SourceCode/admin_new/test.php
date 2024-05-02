<?php
// require_once('../lib/database.php');
// require_once('../lib/initialize.php');
$errors = [];

function validateUploadImage()
{
  global $errors;
  $allowed_image_extension = array("png", "jpg", "jpeg");
  $i = 0;
  foreach ($_FILES['file-input']['name'] as $imageName) {
    $file_extension = pathinfo($imageName, PATHINFO_EXTENSION);
    $size = $_FILES["file-input"]["size"][$i];
    if (!in_array($file_extension, $allowed_image_extension)) {
      $errors[] = "$imageName: Invalid image.";
    } elseif ($size > 5000000) {
      $errors[] = "$imageName: Exceed allowed size:";
    } 
    $i++;
  }
}

if (isset($_POST["upload"])) {
  echo count($_FILES['file-input']['name']);
  var_dump($_FILES['file-input']['name']);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="XnZlTlsfi4ltalF9Gs0ctgxAFticWcMiFpsjjASB">

  <title>Category</title>
  <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
  <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
  <link href="http://demo-classifieds-directory.quickadminpanel.com/css/custom.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
  <h2>PHP Image Upload with Size Type Dimension Validation</h2>
  <form id="frm-image-upload" action="#" name='img' method="post" enctype="multipart/form-data">
    <div class="form-row">
      <div>Choose Image file:</div>
      <div>
        <input type="file" class="file-input" name="file-input[]" multiple>
        <!-- accept="image/*" -->
      </div>
    </div>

    <div class="button-row">
      <input type="submit" id="btn-submit" name="upload" value="Upload">
    </div>
  </form>
  <?php if (!empty($response)) { ?>
    <div class="response <?php echo $response["type"]; ?>
    ">
      <?php echo $response["message"]; ?>
    </div>
  <?php } ?>
</body>

</html>
<?php
// db_disconnect($db);
?>