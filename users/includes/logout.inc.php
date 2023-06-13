<?php
session_start();

if (isset($_POST['logout-submit'])) {
    
    include('../../includes/autoloader.inc.php');

    $user = new Users;
    $user->logoutUser($_SESSION['email']);
    header("Location: ../../index.php");
}