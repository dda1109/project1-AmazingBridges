<?php
require_once('../lib/database.php');
$thisPage = 'Search';

if (isset($_GET['q'])) {
    $input = $_GET['q'];
    $result_set = search($input);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>All Bridges</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mainStyle.css">
</head>

<body>
    <?php include('nav.php'); ?>
    <div class="container content">
        <?php if (mysqli_num_rows($result_set) == 0) : ?>
            <h3>There is no result for "<?php echo $input ?>".</h3>
        <?php else : ?>

            <h3>results for "<?php echo $input ?>":</h3>
            <?php
            $row_count = ceil(mysqli_num_rows($result_set) / 3);
            for ($rowIndex = 0; $rowIndex < $row_count; $rowIndex++) :
            ?>
                <div class="row">
                    <?php
                    for ($colIndex = 0; $colIndex < 3; $colIndex++) :
                        if ($bridge = mysqli_fetch_assoc($result_set)) :
                            $profilePic = get_profile_picture_of_bridge($bridge['bridgeID']);
                    ?>
                            <div class="col-sm-4">
                                <div class="bridge">
                                    <div class="card">
                                        <div class="embed-responsive embed-responsive-4by3">
                                            <div class="imageWrapper embed-responsive-item">
                                                <img src="<?php echo $profilePic['link'] ?>" class="card-img-top lazy" alt="...">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <h5 class="card-title"><?php echo $bridge['name'] ?></h5>
                                                    <h6 class="card-subtitle"><?php echo $bridge['country'] ?></h5>
                                                        <p class="card-text"><?php echo $bridge['opened'] ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="bridge.php?id=<?php echo $bridge['bridgeID'] ?>"><i class="fa fa-paper-plane fa-lg"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endif;
                    endfor ?>
                </div>
        <?php endfor;
            mysqli_free_result($result_set);
        endif; ?>
    </div>
    <?php include('footer.php') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>