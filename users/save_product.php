<?php
session_start();
include('../includes/autoloader1.inc.php');

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$user = new Users;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $productId = $_POST["product_id"];
  $user->saveProductForLater($_SESSION["user_id"], $productId);
}
?>