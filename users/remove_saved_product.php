<?php
session_start();
include('../includes/autoloader1.inc.php');

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$user = new Users;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $savedProductId = $_POST["saved_product_id"];
    $user->removeSavedProduct($savedProductId);
}
?>