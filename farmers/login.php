<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <style>
        #info-message{
            width: auto;
            color: red;
            font-size: 24px;
            font-style: italic;
            
        }
    </style>
    <link rel="stylesheet" href="farmer's_login.css">
</head>

<body>
    <div>
        <form class="box" action="includes/login.inc.php" method="post">
            <h1>Login</h1>
            <input type="text" id="username" placeholder="Enter your name" name="farmer_email" required>
            <input type="password" id="password" placeholder="Enter your password" name="farmer_password" required>
            
            <button type="submit" name="submit">Login</button>
            <p>Don't have an account?</p>
            <a href="register.php">Sign Up</a><br>
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error']=="email"){
                        echo '<p id="info-message">Invalid Email!</p>';
                    }
                    else if($_GET['error']=="pwd"){
                        echo '<p" id="info-message">Invalid Password!</p>';
                    }
                    else if($_GET['error']=="no farmer"){
                        echo '<p id="info-message">No Farmer Exist With These Credentials!!</p>';
                    }
                    else if($_GET['error']=="wrong pwd"){
                        echo '<p id="info-message">Wrong Password!!</p>';
                    }
                }
            ?>
        </form>
    </div>


    <script>
        setTimeout(function(){
            document.getElementById('info-message').style.display = 'none';
        }, 4000);
    </script>

</body>

</html>