<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Farmers</title>
  <style>
    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  background-color: #f5f5f5;
}

main {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  margin-bottom: 20px;
  text-align: center;
}

.farmer-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 20px;
}

.farmer-card {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  overflow: hidden;
}

.farmer-card:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.farmer-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.farmer-card h2 {
  margin: 10px;
  font-size: 24px;
  font-weight: bold;
}

.farmer-card p {
  margin: 10px;
  font-size: 16px;
  line-height: 1.5;
}

.farmer-card a {
  display: block;
  margin: 10px;
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  color: #fff;
  background-color: #007bff;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
}

.farmer-card a:hover {
  background-color: #0069d9;
}
.return-link-header{
  display: block;
  width: 50%;
  margin-top: 20px;
  margin-bottom: 7px;
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
        $sender_Id = $_SESSION['user_unique_id'];
      ?>
  <main>
    <h1>All Farmers</h1>
    <a href="dashboard.php?msg=Returned Back To Dashboard!" class="return-link-header">Return to Dashboard</a>
    <div class="farmer-grid">
      <?php while ($row = mysqli_fetch_assoc($result)) {
        
      ?>
        <div class="farmer-card">
          <img src="../farmers/public/farmerProfileImages/work-1.png" alt="<?php echo $row['farmer_name']; ?>">
          <h2><?php echo $row['farmer_name']; ?></h2>
          <p><?php echo $row['farmer_address']; ?></p>
          <a href="farmer_profile.php?id=<?php echo $row['farmer_id']; ?>">View Profile</a>
          <a href="messaging.php?<?php echo 'receiverId='.$row['unique_id'].'&senderId='.$sender_Id; ?>" class="return-link">Message Now</a>
        </div>
        <?php 
      }
        ?>
        
    </div>
    
  </main>
</body>
</html>