<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        #info-message{
            width: auto;
            color: red;
            font-size: 24px;
            font-style: italic;
            
        }
    </style>
    <link rel="stylesheet" href="farmer's_register.css">
</head>
<title>Sign up</title>
</head>

<body>
    <div>
        <form class="box1" action="includes/signup.inc.php" method="post">
            <h1>Sign Up</h1>
            <input type="text" id="firstname" placeholder="Name" name="farmer_name" required>
            <input type="text" id="lastname" placeholder="Email" name="farmer_email" required>
            <input type="text" id="phonenumber" placeholder="Address" name="farmer_address"  required>
            <input type="password" id="password" placeholder="Create Password" name="farmer_password" required>
            <input type="text" id="passwordc" placeholder="Phone"  name="farmer_phone" required>
            <button type="submit" name="submit">sign up</button>
            
            <p>Already have an account?</p>
            <a href="login.php">Log in </a><br><br>
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error']=="email"){
                        echo '<p id="info-message">Invalid Email!</p>';
                    }
                    else if($_GET['error']=="name"){
                        echo '<p" id="info-message">Invalid Name!</p>';
                    }
                    else if($_GET['error']=="farmer exist"){
                        echo '<p id="info-message">Farmer Exist With These Credentials!!</p>';
                    }
                    else if($_GET['error']=="pwd"){
                        echo '<p id="info-message">Invalid Password(must be greater than 5 characters)!!</p>';
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