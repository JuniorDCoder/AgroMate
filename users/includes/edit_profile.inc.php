<?php
include('../../includes/autoloader.inc.php');
session_start();


if ($_SESSION['userLogged']!= true) {
    header("Location: ../login.php?error=No session found!");
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


if (isset($_POST['submit'])) {
    $user_image = $_FILES['user_image'];
    $imageName = $user_image['name'];
    $fileType = $user_image['type'];
    $fileSize = $user_image['size'];
    $fileTmpName = $user_image['tmp_name'];
    $fileError = $user_image['error'];
            
    $fileImageData = explode('/',$fileType);
            
    $fileExtension = $fileImageData[count($fileImageData)-1];
    
    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_phone'];
    $user_address = $_POST['user_address'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $user = new Users;
    $result = $user->getUser($_SESSION['user_email']);
    $row = mysqli_fetch_assoc($result);

    if ( $user->uploadProfilePicture($id, $fileSize, $fileExtension, $fileTmpName, $imageName, $row['user_name'],$row['user_address'], $row['user_phone'])) {
        header("Location: ../profile.php?error=none");
        exit();
   }
   else if( $user->uploadProfilePicture($id, $fileSize, $fileExtension, $fileTmpName, $imageName, $row['user_name'],$row['user_address'], $row['user_phone']) === 1){
        header("Location: ../profile.php?error=ext");
        exit();
   }
   else if( $user->uploadProfilePicture($id, $fileSize, $fileExtension, $fileTmpName, $imageName, $row['user_name'],$row['user_address'], $row['user_phone']) === 0){
        header("Location: ../profile.php?error=size");
        exit();
    }
}