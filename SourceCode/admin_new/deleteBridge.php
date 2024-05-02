<?php
require_once('../lib/database.php');
require_once('../lib/initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    delete_profilePic($_POST['id']);
    delete_bridge($_POST['id']);
    redirect_to('indexBridge.php');
}

db_disconnect($db);
?>