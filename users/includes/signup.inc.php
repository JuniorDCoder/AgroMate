<?php

if (isset($_POST['submit'])) {
    include('../../includes/autoloader.inc.php');
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_password = $_POST['user_password'];
    $user_phone = $_POST['user_phone'];
    
    $unique_id = rand(time(), 10000);
    $user = new Users;

    if ($user->addUser($unique_id,$user_name,$user_email,$user_address,$user_phone,$user_password) === 0) {
        
        //Invalid Name
        header("Location: ../register.php?error=name");
        exit();
    }
    else if($user->addUser($unique_id, $user_name,$user_email,$user_address,$user_phone,$user_password) === 1){
        //Invalid Email
        header("Location: ../register.php?error=email");
        exit();
    }
    else if($user->addUser($unique_id, $user_name,$user_email,$user_address,$user_phone,$user_password) === 2){
        //Invalid Password
        header("Location: ../register.php?error=pwd");
        exit();
    }
    else if($user->addUser($unique_id, $user_name,$user_email,$user_address,$user_phone,$user_password) == 3){
        //User Already Exist with the username and Email
        header("Location: ../register.php?error=user exist");
        exit();
    }
    else if($user->addUser($unique_id, $user_name,$user_email,$user_address,$user_phone,$user_password)===true){
        //Registered Successfully
        session_start();

        $_SESSION['userLogged'] = true;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_unique_id'] = $user_unique_id;
        $_SESSION['user_email'] = $user_email;
        header("Location: ../dashboard.php");
        exit();
    }
    
}