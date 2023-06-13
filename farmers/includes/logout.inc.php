<?php
session_start();

if (isset($_POST['logout-submit'])) {
    
    include('../../includes/autoloader.inc.php');

    $user = new Farmers;
    $user->logoutFarmer($_SESSION['email']);
    header("Location: ../../index.php");
}