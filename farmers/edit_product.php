<?php
 session_start();
 if($_SESSION['farmerLogged']!=true){
    header("Location: login.php?msg=No Session Exist!");
    die();
        
}
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <title>Edit Product</title>
    </head>

    <body>
        <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#00ff5573;">
            Farmer Dashboard!
        </nav>
        <?php
            include('../includes/autoloader1.inc.php');
            $product = new Products();
            $result = $product->getParticularProduct($id);
            $row = mysqli_fetch_assoc($result);
        ?>

        <div class="container">
            <div class="text-center" mb-4>
                <h3>Update Product</h3>
                <p class="text-muted">Complete the below form to Update your Product!</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="includes/edit_product.inc.php" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
                    <div class="row mb-3">
                        <div class="col">
                            <label class ="form-label">Product Name:</label>
                            <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']; ?>">
                        </div>
                        <div class="col">
                            <label class ="form-label">Farmer Name:</label>
                            <input type="text" class="form-control" name="farmer_name" value="<?php echo $row['farmer_name']; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class ="form-label">Product Price :</label>
                            <input type="text" class="form-control" name="product_price" value="<?php echo $row['product_price']; ?>">
                        </div>
                        <div class="col">
                            <label class="form-label">Product Description :</label>
                            <textarea type="text" class="form-control" name="product_description"><?php echo $row['product_description']; ?></textarea>
                        </div>
                        
                       
                    </div>
                    
                        <div class="row mb-3">
                        <?php echo '<img  style = " border-radius: 10px;height: 100px; width: 100px;"src = "public/farmerProductImages/'.($row["image_name"]).'">'; ?>
                        
                        <input type="file" class="form-control" name="image">
                        
                    </div>
                   
                    <?php

                            if (isset($_GET['error'])) {
                                if ($_GET['error']=="size") {
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Image must be less than 2MB</strong>
                                    </div>';
                                }
                                else if($_GET['error'] == "none"){
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Product Updated Successfully!</strong>
                                    </div>';
                                }
                                else if($_GET['error'] == 'ext'){
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Invalid File Extension!</strong>
                                    </div>';
                                }
                                else if($_GET['error'] == 'failedtoupload'){
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" rolw="alert" id="info-message"><strong>Failed to Upload. Some erorr occured!</strong>
                                    </div>';
                                }
                            }
                        ?>

                    <div>
                        <button type="submit" class="btn btn-success" name="submit">UpdateProduct</button>
                        <a href="products.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script>
            setTimeout(function(){
                document.getElementById('info-message').style.display = 'none';
            }, 4000);
        </script>
    </body>
</html>
