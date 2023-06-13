<?php
include('../../includes/autoloader.inc.php');
session_start();



if ($_SESSION['farmerLogged']!= true) {
    header("Location: ../login.php?error=No session found!");
    exit();
}


/*if (isset($_POST['submit'])) {
    $product_image = $_FILES['product_image'];
    $imageName = $product_image['name'];
    $fileType = $product_image['type'];
    $fileSize = $product_image['size'];
    $fileTmpName = $product_image['tmp_name'];
    $fileError = $product_image['error'];
            
    $fileImageData = explode('/',$fileType);
            
    $fileExtension = $fileImageData[count($fileImageData)-1];

    $product_name = $_POST['product_name'];
    $farmer_name = $row['farmer_name'];
    $farmer_phone = $row['farmer_phone'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];

    $product = new Products;

   if ( $product->addProductPicture($fileSize, $fileExtension, $fileTmpName, $imageName,$farmer_name,$farmer_phone, $product_name, $product_description, $product_price)==true) {        
        header("Location: ../add_product.php?error=none");
        exit();
    }
   else if( $product->addProductPicture($fileSize, $fileExtension, $fileTmpName, $imageName,$farmer_name,$farmer_phone, $product_name, $product_description, $product_price) === 1){
        header("Location: ../add_product.php?error=ext");
        exit();
   }
   else if( $product->addProductPicture($fileSize, $fileExtension, $fileTmpName, $imageName,$farmer_name,$farmer_phone, $product_name, $product_description, $product_price) === 0){
        header("Location: ../add_product.php?error=size");
        exit();
    }

    
}*/

if (isset($_POST['submit'])) {
    if(isset($_POST['product_name']) && (isset($_POST['product_price'])) && (isset($_POST['product_description']))){
        $dbh = new Dbh();
        $product_image = $_FILES['image'];
        $imageName = $product_image['name'];
        $fileTmpName = $product_image['tmp_name'];
        $fileSize = $product_image['size'];
        $fileType = $product_image['type'];
        $fileImageData = explode('/',$fileType);
            
        $fileExtension = $fileImageData[count($fileImageData)-1];

        $farmer = new Farmers;
        $result = $farmer->getFarmer($_SESSION['farmer_email']);
        $row = mysqli_fetch_assoc($result);

        $product_name = $_POST['product_name'];
        $farmer_name = $row['farmer_name'];
        $farmer_phone = $row['farmer_phone'];
        $product_price = $_POST['product_price'];
        $product_description = $_POST['product_description'];
        
        $farmer_email = $_SESSION['farmer_email'];

        $product = new Products();
        if ($product->addProductPicture($fileSize, $fileExtension, $fileTmpName, $imageName,$farmer_name, $farmer_email,$farmer_phone, $product_name, $product_description, $product_price)) {
           header("Location: ../add_product.php?error=none");
           exit();
        }
        else if($product->addProductPicture($fileSize, $fileExtension, $fileTmpName, $imageName,$farmer_name, $farmer_email,$farmer_phone, $product_name, $product_description, $product_price)===1) {
            header("Location: ../add_product.php?error=ext");
            exit();
        }
        else if($product->addProductPicture($fileSize, $fileExtension, $fileTmpName, $imageName,$farmer_name, $farmer_email,$farmer_phone, $product_name, $product_description, $product_price)===0) {
            header("Location: ../add_product.php?error=size");
            exit();
        } 
        else {
            header("Location: ../add_product.php?error=try again");
            exit();
        }
    }
    else{
        ?>
                    
        <script type = "text/javascript">
        alert("Please Complete the Form ");
        window.location.href = "../add_product.php";
        </script>
    
        <?php
    
    }
}

function saveimage($image_name, $product_image){
    

}