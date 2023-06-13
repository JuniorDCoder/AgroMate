<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Rating</title>
<style>
.rating-form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  background-color: #fff;
}

.rating-form h2 {
  margin-top: 0;
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  color: #333;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-size: 18px;
  font-weight: bold;
  color: #333;
}

select,
textarea,input {
  display: block;
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
  color: #333;
  background-color: #fff;
  resize: vertical;
}

button[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  color: #fff;
  background-color: #007bff;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #0069d9;
}
.rating-dropdown {
  appearance: none;
  -webkit-appearance: none;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
  color: #333;
  background-color: #fff;
}

.rating-dropdown option {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  font-size: 16px;
  color: #333;
  background-color: #fff;
}

.rating-dropdown option:last-of-type {
  border-bottom: none;
}
.return-link {
  display: block;
  margin-top: 20px;
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  color: #fff;
  background-color: red;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
}

.return-link:hover {
  background-color: #7fff00;
}
        </style>
    </head>
    <body>
        <?php
            include('../includes/autoloader1.inc.php');
            $farmers = new Farmers;
            $result = $farmers->getAllExistingFarmers();
        ?>
        <div class="rating-form">
            <h2>Rate Farmer</h2>
            <form action="submit_rating.php" method="POST">
                
                <div class="form-group">
                <label for="farmer_name">Farmer </label>
                <select name="farmer_email" id="farmer_name" class="rating-dropdown">
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option >'.$row['farmer_email'].'</option>'.'( '.$row['farmer_name'].' )';
                        }
                    ?>
                    
                    
                </select>
                </div>
                <div class="form-group">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" class="rating-dropdown">
                    <option value="1">1 star</option>
                    <option value="2">2 stars</option>
                    <option value="3">3 stars</option>
                    <option value="4">4 stars</option>
                    <option value="5">5 stars</option>
                </select>
                </div>
                <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment"></textarea>
                </div>
                <div class="form-group">
                <button type="submit">Submit</button>
                </div>
            </form>
            <a href="dashboard.php?msg=Returned Back To Dashboard!" class="return-link">Return to Dashboard</a>
        </div>
    </body>
</html>