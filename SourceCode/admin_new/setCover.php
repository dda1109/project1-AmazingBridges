<?php
require_once('../lib/database.php');
require_once('../lib/initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    make_profile_pic($_POST['imageID'],$_POST['bridgeID']);
    redirect_to('view.php?id=' . $_POST['bridgeID']);
} ?>