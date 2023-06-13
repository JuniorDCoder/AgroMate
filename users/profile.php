<?php
    session_start();
    if($_SESSION['userLogged']!=true){
        header("Location: login.php?msg=No Session Exist!");
        die();
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>

    <?php
        include('../includes/autoloader1.inc.php');

        $user = new Users;
        $result = $user->getUser($_SESSION['user_email']);
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container rounded bg-white mt-5 mb-5">
        <form action="includes/edit_profile.inc.php" method="post" enctype="multipart/form-data">
            <div class="row  w-auto">
                <div class="col md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px" src="public/userProfileImages/<?php echo $row['profile_picture']; ?>">
                            
                            <input type="file" name="user_image" class="mt-2"><br>
                           
                            <span class="font-weight-bold"><?php echo $row['user_name']; ?></span>
                            <span style="color:black;font-size:22px;"><em><?php echo $row['user_email']; ?></em></span></div>         
                </div>
                <div class="col md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col md-6"><label class="labels">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name</label>
                                <input type="text" name="user_name" class="form-control"  value="<?php echo $row['user_name']; ?>">
                        
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col md-12"><label class="labels">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile Number</label>
                                <input name="user_phone"  type="text" class="form-control" value="<?php echo $row['user_phone']; ?>">
                            </div>
                            <div class="col md-12"><label class="labels">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address</label>
                                <input name="user_address" type="text" class="form-control" value="<?php echo $row['user_address']; ?>">
                            </div>
    
                        </div>
                        <div class="row mt-3">
                            <h5 class="text-center">Change Password</h5>
                            <div class="col md-12"><label class="labels">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Old Password</label>
                                <input name="old_password"  type="text" class="form-control" placeholder="Old Password" readonly="readonly">
                            </div>
                            <div class="col md-12"><label class="labels">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Password</label>
                                <input name="new_password" type="text" class="form-control" placeholder="New Password">
                            </div>
    
                        </div>
                        <?php

                            if (isset($_GET['error'])) {
                                if ($_GET['error']=="name") {
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Invalid Name</strong>
                                    </div>';
                                }
                                else if ($_GET['error']=="pwd") {
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Invalid Password(Must be greater than 5 characters)</strong>
                                    
                                    </div>';
                                }
                                else if($_GET['error'] == "none"){
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Profile Updated Successfully!</strong>
                                    </div>';
                                }
                                else if($_GET['error'] == 'some error'){
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>An error occured. Try again later!</strong>
                                    </div>';
                                }
                                else if($_GET['error'] == 'failedtoupload'){
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Failed to Upload. Some erorr occured!</strong>
                                    </div>';
                                }
                            }
                        ?>
                        </div>
                        <div class="mt-3 text-center"><button class="btn btn-primary profile-button" type="submit" name="submit">Update Profile</button></div>
                        <div class="mt-3 text-center"><a href="dashboard.php?msg=Returned Back To Dashboard!" class="btn btn-danger">Back To Dashboard</a>
                    </div>
                </div>
            
            </div>
        </form>
    </div>
    <script>
        setTimeout(function(){
            document.getElementById('info-message').style.display = 'none';
        }, 4000);
    </script>
</body>
</html>

