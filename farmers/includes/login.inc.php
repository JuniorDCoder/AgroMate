<?php
if (isset($_POST['submit'])) {
    include('../../includes/autoloader.inc.php');
   
    $farmer_email = $_POST['farmer_email'];
    $farmer_password = $_POST['farmer_password'];
    
    $farmer = new Farmers;
    if($farmer->loginFarmer($farmer_email, $farmer_password) === -1){
       
        // Invalid Email
        header("Location: ../login.php?error=email");
        exit();
    }
    else if($farmer->loginFarmer($farmer_email, $farmer_password) === 2){
        
        //Invalid Password
        header("Location: ../login.php?error=pwd");
        exit();
    }
    else if ($farmer->loginFarmer($farmer_email, $farmer_password) === 0) {
        
        //No farmer Exist
        header("Location: ../login.php?error=no farmer");
        exit();
    }
    else if ($farmer->loginFarmer($farmer_email, $farmer_password) || $farmer->loginFarmer($farmer_email, $farmer_password) === 1) {
        //Login Successfully
        session_start();
        $result = $farmer->getFarmer($farmer_email);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['farmerLogged'] = true;
        $_SESSION['farmer_id'] = $row['farmer_id'];
        $_SESSION['farmer_name'] = $row['farmer_name'];
        $_SESSION['unique_id'] = $row['unique_id'];
        $_SESSION['farmer_email'] = $row['farmer_email'];
        header("Location: ../dashboard.php");
        exit();
        
    }
    else if($farmer->loginFarmer($farmer_email, $farmer_password)===false){
        //Wrong pwd
        header("Location: ../login.php?error=wrong pwd");
        exit();
    }
}