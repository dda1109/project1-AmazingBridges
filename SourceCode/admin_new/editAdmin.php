<?php
require_once('../lib/database.php');
require_once('../lib/initialize.php');
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    checkFormAdmin();
    if (isFormValidated()) {
        $admin = [];
        $admin['id'] = $_POST['id'];
        $admin['name'] = $_POST['name'];
        $admin['email'] = $_POST['email'];
        $admin['pwd'] = $_POST['pwd'];
        update_admin($admin);
        redirect_to('indexAdmin.php');
    }
} else {
    if (!isset($_GET['id'])) {
        redirect_to('indexAdmin.php');
    }
    $id = $_GET['id'];
    $admin = find_admin_by_id($id);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="0vBGoLVLv81Vjwhi4DExFrFtFurWXB86hnuNWNaF">

    <title>Edit Admin</title>
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="http://demo-classifieds-directory.quickadminpanel.com/css/custom.css" rel="stylesheet" />
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <?php include('header.php') ?>
    <div class="app-body">
        <?php include('sidebar.php') ?>
        <main class="main">
            <div style="padding-top: 20px" class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Edit Admin
                    </div>

                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" novalidate>
                            <input type="hidden" name="id" value="<?php echo isFormValidated() ? $admin['adminID'] : $_POST['id'] ?>">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo isFormValidated() ? $admin['adminName'] : $_POST['name'] ?>">
                                <p class="helper-block text-danger">
                                    <?php echo isset($errors['name']) ? $errors['name'] : '' ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="email" name="email" class="form-control" value="<?php echo isFormValidated() ? $admin['email'] : $_POST['email'] ?>">
                                <p class="helper-block text-danger">
                                    <?php echo isset($errors['email']) ? $errors['email'] : '' ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password*</label>
                                <input type="password" name="pwd" class="form-control"placeholder="Minimum eight characters, at least one letter and one number">
                                <p class="helper-block text-danger">
                                    <?php echo isset($errors['pwd']) ? $errors['pwd'] : '' ?>
                                </p>
                            </div>

                            <input class="btn btn-danger" type="submit" name="submit" value="Save">
                        </form>
                        <br><br>
                        <a href="indexAdmin.php">Back to index</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
</body>

</html>

<?php
db_disconnect($db);
?>