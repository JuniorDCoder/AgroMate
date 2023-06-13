<?php
if (isset($_POST['submit'])) {
    include('../../includes/autoloader.inc.php');
    $farmer_name = $_POST['farmer_name'];
    $farmer_email = $_POST['farmer_email'];
    $farmer_address = $_POST['farmer_address'];
    $farmer_password = $_POST['farmer_password'];
    $farmer_phone = $_POST['farmer_phone'];
    
    $unique_id = rand(time(), 10000);
    $farmer = new Farmers;

    if ($farmer->addFarmer($unique_id,$farmer_name,$farmer_email,$farmer_address,$farmer_phone,$farmer_password) === 0) {
        
        //Invalid Name
        header("Location: ../register.php?error=name");
        exit();
    }
    else if($farmer->addFarmer($unique_id, $farmer_name,$farmer_email,$farmer_address,$farmer_phone,$farmer_password) === 1){
        //Invalid Email
        header("Location: ../register.php?error=email");
        exit();
    }
    else if($farmer->addFarmer($unique_id, $farmer_name,$farmer_email,$farmer_address,$farmer_phone,$farmer_password) === 2){
        //Invalid Password
        header("Location: ../register.php?error=pwd");
        exit();
    }
    else if($farmer->addFarmer($unique_id, $farmer_name,$farmer_email,$farmer_address,$farmer_phone,$farmer_password)== 3){
        //farmer Already Exist with the farmername and Email
        header("Location: ../register.php?error=farmer exist");
        exit();
    }
    else if($farmer->addFarmer($unique_id, $farmer_name,$farmer_email,$farmer_address,$farmer_phone,$farmer_password) === true){
        //Registered Successfully
        session_start();
        $_SESSION['farmerLogged'] = true;
        
        $_SESSION['farmer_name'] = $farmer_name;
        $_SESSION['unique_id'] = $unique_id;
        $_SESSION['farmer_email'] = $farmer_email;
        header("Location: ../dashboard.php");
        exit();
    }
    
}