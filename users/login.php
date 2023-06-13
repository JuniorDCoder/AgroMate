<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMate Login</title>
     
    <style>
        #info-message{
            width: auto;
            color: red;
            font-size: 24px;
            font-style: italic;
            
        }
        body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background-color: white;
    background-size: cover;

    }

    .box {
        width: 300px;
        padding: 30px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: black;
        text-align: center;
        position: absolute;
    }

    .box h1 {
        color: chartreuse;
        font-weight: 700;

    }

    .box input[type="text"],
    .box input[type="password"] {
        border: 0;
        background: none;
        display: block;
        margin: 20px auto;
        text-align: center;
        border: 3px solid white;
        padding: 14px 10px;
        width: 220px;
        outline: none;
        color: burlywood;
        border-radius: 24px;
        transition: 0.25px;

    }

    .box input[type="text"]:focus,
    .box input[type="password"]:focus {
        width: 270px;
        border-color: chartreuse;

    }

    .box input[type="submit"] {
        border: 0;
        background: none;
        display: block;
        margin: 20px auto;
        text-align: center;
        border: 3px solid white;
        padding: 14px 10px;

        outline: none;
        color: chartreuse;
        border-radius: 24px;
        transition: 0.25px;
        cursor: pointer;

    }

    .box input[type="submit"]:hover {
        background: chartreuse;
        color: #000;
    }

    p{
        color: chartreuse;
        text-align: center;
        size: 10px;
    }

    </style>

<body>
    <form class="box" action="includes/login.inc.php" method="post">
        <h1>LOGIN</h1>
        
        <input type="text" id="username" placeholder="Enter your Email" name="user_email" required>
        <input type="password" name="user_password" id="password" placeholder="Enter your Password" required>
        <?php
                if(isset($_GET['error'])){
                    if($_GET['error']=="email"){
                        echo '<p id="info-message">Invalid Email!</p>';
                    }
                    else if($_GET['error']=="pwd"){
                        echo '<p" id="info-message">Invalid Password(must be greater than 5 characters)!</p>';
                    }
                    else if($_GET['error']=="no user"){
                        echo '<p id="info-message">No User Exist With These Credentials!!</p>';
                    }
                    else if($_GET['error']=="wrong pwd"){
                        echo '<p id="info-message">Wrong Password!!</p>';
                    }
                }
            ?>
        <input type="submit" name="submit" value="Login">
        <p>Don't have an account?</p>
        <a href="register.php">Sign Up</a>
    </form>

    <script>
        setTimeout(function(){
            document.getElementById('info-message').style.display = 'none';
        }, 4000);
    </script>

</body>

</html>