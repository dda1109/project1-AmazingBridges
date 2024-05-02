<?php
require_once('../lib/initialize.php');
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
}

redirect_to('login.php');
?>