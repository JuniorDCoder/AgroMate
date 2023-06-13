<?php
    session_start();
    if($_SESSION['farmerLogged']!=true){
        header("Location: login.php?msg=No Session Exist!");
        die();
        
    }

    if(isset($_GET['id'])){
      include('../includes/autoloader1.inc.php');
      $product = new Products();
      $product->deleteProduct($_GET['id']);
      header('Location: products.php?error=none');
  }

 
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Your Products</title>

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
            if (confirm('Are You Sure to Delete this Product?'))
            {
                window.location.href = 'products.php?id=' + id;
            }
        }
      </script>
    </head>
    <body>
    <div class="container">
        <p class="lead mt-2">View All Your Products</p>

        <table class="table table-hover text-center"> 
          <thead class="table-dark">
            <tr>
              <td scope="col">ID</td>
              <td scope="col">Product Name</td>
              <td scope="col">Product Description</td>
              <td scope="col">Product Price</td>
              <td scope="col">Product Image</td>
              <td scope="col">Actions</td>
            </tr>
          </thead>

          <tbody>

            <?php
                include('../includes/autoloader1.inc.php');

                $product = new Products();
                $result = $product->getAllFarmerProducts($_SESSION['farmer_name']);
                
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?php echo $row['product_id']; ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['product_description']; ?></td>
                  <td><?php echo $row['product_price']; ?></td>
                  <td><?php echo '<img style ="border-radius: 10px;height: 45px; width: 45px;"src = "public/farmerProductImages/'.($row["image_name"]).'">'; ?></td>
                  <td>
                    <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-3 me-3"></i></a>
                    <a href="javascript: delete_product(<?php echo $row['product_id']; ?>)" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
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
              echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Product Deleted Successfully!</strong>
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