<?php


if (isset($_POST['submit'])) {
    include('../../includes/autoloader.inc.php');
   
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    $user = new Users;

    if($user->loginUser($user_email, $user_password) === -1){
       
        // Invalid Email
        header("Location: ../login.php?error=email");
        exit();
    }
    else if($user->loginUser($user_email, $user_password) === 2){
        
        //Invalid Password
        header("Location: ../login.php?error=pwd");
        exit();
    }
    else if ($user->loginUser($user_email, $user_password) === 0) {
        
        //No User Exist
        header("Location: ../login.php?error=no user");
        exit();
    }
    else if ($user->loginUser($user_email, $user_password) || $user->loginUser($user_email, $user_password) === 1) {
        //Login Successfully
        session_start();
        $result = $user->getUser($user_email);
        $users = mysqli_fetch_assoc($result);
        
        $_SESSION['userLogged'] = true;
        $_SESSION['user_id'] = $users['user_id'];
        $_SESSION['user_name'] = $users['user_name'];
        $_SESSION['user_unique_id'] = $users['unique_id'];
        $_SESSION['user_email'] = $users['user_email'];

   
        header("Location: ../dashboard.php");
        exit();
        
    }
    else if($user->loginUser($user_email, $user_password)===false){
        //Wrong pwd
        header("Location: ../login.php?error=wrong pwd");
        exit();
    }
}