<?php
include('../../includes/autoloader.inc.php');
session_start();


if ($_SESSION['farmerLogged']!= true) {
    header("Location: ../login.php?error=No session found!");
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


if (isset($_POST['submit'])) {
    $farmer_image = $_FILES['farmer_image'];
    $imageName = $farmer_image['name'];
    $fileType = $farmer_image['type'];
    $fileSize = $farmer_image['size'];
    $fileTmpName = $farmer_image['tmp_name'];
    $fileError = $farmer_image['error'];
            
    $fileImageData = explode('/',$fileType);
            
    $fileExtension = $fileImageData[count($fileImageData)-1];
    
    $farmer_name = $_POST['farmer_name'];
    $farmer_phone = $_POST['farmer_phone'];
    $farmer_address = $_POST['farmer_address'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $farmer = new Farmers;
    $result = $farmer->getfarmer($_SESSION['farmer_email']);
    $row = mysqli_fetch_assoc($result);

    if ( $farmer->uploadProfilePicture($id, $fileSize, $fileExtension, $fileTmpName, $imageName, $row['farmer_name'],$row['farmer_address'], $row['farmer_phone'])) {
        header("Location: ../profile.php?error=none");
        exit();
   }
   else if( $farmer->uploadProfilePicture($id, $fileSize, $fileExtension, $fileTmpName, $imageName, $row['farmer_name'],$row['farmer_address'], $row['farmer_phone']) === 1){
        header("Location: ../profile.php?error=ext");
        exit();
   }
   else if( $farmer->uploadProfilePicture($id, $fileSize, $fileExtension, $fileTmpName, $imageName, $row['farmer_name'],$row['farmer_address'], $row['farmer_phone']) === 0){
        header("Location: ../profile.php?error=size");
        exit();
    }
}