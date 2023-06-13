<?php
    session_start();
    if($_SESSION['farmerLogged']!=true){
        header("Location: login.php?msg=No Session Exist!");
        die();
        
    }
    if(isset($_GET['id'])){
        include('../includes/autoloader1.inc.php');
        $product = new Ratings;
        $product->deleteRating($_GET['id']);
        header('Location: ratings.php?error=none');
    }

 
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Your Ratings</title>

        <link href="../css/dashboard.css" rel="stylesheet" type="text/css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
       
        <!------ Include the above in your HEAD tag ---------->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

		    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src='https://use.fontawesome.com/releases/v5.0.8/js/all.js'></script>	
        <script type="text/javascript">
        function delete_product(id)
        {
            if (confirm('Are You Sure to Delete this Rating?'))
            {
                window.location.href = 'ratings.php?id=' + id;
            }
        }
      </script>
    </head>
    <body>
    <div class="container">
        <p class="lead mt-2">View All Your Ratings</p>

        <table class="table table-hover text-center"> 
          <thead class="table-dark">
            <tr>
              <td scope="col">ID</td>
              <td scope="col">User ID</td>
              <td scope="col">Rating</td>
              <td scope="col">Comment</td>
              
              <td scope="col">Actions</td>
            </tr>
          </thead>

          <tbody>

            <?php
                include('../includes/autoloader1.inc.php');
                
                

                $rating = new Ratings;
                $result = $rating->getTotalRatings($_SESSION['farmer_id']);
                
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['user_id']; ?></td>
                  <td><?php echo $row['rating'].' /5 stars'; ?></td>
                  <td><?php echo $row['comment']; ?></td>
                  
                  <td>
                    <a href="javascript: delete_rating(<?php echo $row['id']; ?>)" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                  </td>
                </tr>

                <?php
              }
            ?>
      
          </tbody>
        </table>
        <?php
           if (isset($_GET['error'])) {
            if ($_GET['error'] == "none") {
              echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Rating Deleted Successfully!</strong>
              </div>';
            }
          }

        ?>
        <div class="mt-3 text-center"><a href="dashboard.php?msg=Returned Back To Dashboard!" class="btn btn-danger">Back To Dashboard</a></div>
      </div>

      <script>
            setTimeout(function(){
                document.getElementById('info-message').style.display = 'none';
            }, 4000);
        </script>

    </body>

    
</html>