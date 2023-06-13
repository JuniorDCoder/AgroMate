<?php
session_start();
include('../includes/autoloader1.inc.php');


// Initialize variables
$errorMsg = '';
$farmerId = '';
$rating = '';
$comment = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate form data
  if (!isset($_POST['farmer_email']) || !isset($_POST['rating']) || !is_numeric($_POST['rating'])) {
    $errorMsg = 'Please provide valid data.';
    echo '<script>alert("Please provide valid data.")</script>';
    echo '<script>window.location.href = "rating.php";</script>';
  } else {
    $farmerEmail = $_POST['farmer_email'];
    $userId = $_SESSION['user_id']; // Replace with actual user ID
    $rating = $_POST['rating'];
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

    $farmers = new Farmers;
    
    $result = $farmers->getFarmer($farmerEmail);
    $row = mysqli_fetch_assoc($result);

    // Validate rating value
    if ($rating < 1 || $rating > 5) {
        echo '<script>alert("Please provide valid data.")</script>';
        echo '<script>window.location.href = "rating.php";</script>';
    } else {
      $farmerRating = new Ratings;
      $farmerRating->addRating($row['farmer_id'], $userId, $rating, $comment);

        echo '<script>alert("Rating Added Successfully!")</script>';
        echo '<script>window.location.href = "rating.php";</script>';
      exit;
    }
  }
}

?>
