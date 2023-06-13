<?php

session_start();
$id = $_GET['id'];
    include('../includes/autoloader1.inc.php');
    $farmers = new Farmers;
    $result = $farmers->getFarmerById($id);
    $farmer = mysqli_fetch_assoc($result);

    $rating = new Ratings;
    $result = $rating->getAverageRating($id);
    
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $farmer['farmer_name']; ?> Profile</title>
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

.farmer-profile {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  text-align: center;
}

.farmer-profile img {
  width: 200px;
  height: 200px;
  object-fit: cover;
  border-radius: 50%;
}

.farmer-profile h1 {
  margin: 20px 0;
  font-size: 32px;
  font-weight: bold;
}

.farmer-profile p.location {
  margin-bottom: 20px;
  font-size: 24px;
}

.farmer-profile p.description {
  margin-bottom: 20px;
  font-size: 16px;
}

.contact-info {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.contact-info li {
  margin: 0 10px;
  font-size: 16px;
}

.contact-info li a {
  color: #007bff;
  text-decoration: none;
}

.contact-info li a:hover {
  text-decoration: underline;
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
    <main>
      <div class="farmer-profile">
        <img src="../farmers/public/farmerProfileImages/work-1.png" alt="<?php echo $farmer['farmer_name']; ?>">
        <h1><?php echo $farmer['farmer_name']; ?></h1>
        <p class="location"><?php echo $farmer['farmer_address']; ?></p>
        <p class="description"><?php echo 'Average Rating: ' .round($result).' /5'; ?></p>
        <ul class="contact-info">
          <li><a href="mailto:<?php echo $farmer['farmer_email']; ?>"><?php echo $farmer['farmer_email']; ?></a></li>
          <li><a href="tel:<?php echo $farmer['farmer_phone']; ?>"><?php echo $farmer['farmer_phone']; ?></a></li>
        </ul>
        <a href="all_farmers.php" class="return-link">Return to Farmers Directory</a>
      </div>
    </main>
  </body>
</html>

