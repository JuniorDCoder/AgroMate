<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Saved Products</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet" >
	<link href="..css/font-awesome.min.css" rel="stylesheet" >
  <link href="../css/global.css" rel="stylesheet">
  <link href="../css/about.css" rel="stylesheet">
  <link href="../css/blog.css" rel="stylesheet">
  <link href="../css/contact.css" rel="stylesheet">
  <link href="../css/index.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
<section id="course" class="p_3">
 <div class="container-xl">
		<div class="row course_1">
			<div class="col-md-9">
				<div class="course_1l">
					<h3 class="mb-0">Saved Products</h3>
                    <div class="mt-3 text-center"><a href="dashboard.php?msg=Returned Back To Dashboard!" class="btn btn-danger">Back To Dashboard</a></div>
				</div>
			</div>
            

		</div>
			<?php
		 include('../includes/autoloader1.inc.php');
		
		$user = new Users;
		$result = $user->getSavedProducts($_SESSION['user_id']);

		while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];

            $product = new Products;
		    $resultFetched = $product->getParticularProduct($row['product_id']);
            $rowFetch = mysqli_fetch_assoc($resultFetched);
			?>
        
			<div class="row course_3 mt-4 mb-2">
     	<div class="tab-content">
			<div class="tab-pane active" id="home">
				<div class="course_3i row">
					<div class="col-md-4">
						<div class="course_3im clearfix">
							<div class="course_3im1 position-relative clearfix">
								<div class="course_3im1i clearfix">
									<div class="grid clearfix">
										<figure class="effect-jazz mb-0">
											<a href=""><img src="<?php echo "../farmers/public/farmerProductImages/".$rowFetch['image_name']; ?>" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
								<div class="course_3im1i1 position-absolute w-100 top-0 clearfix p-3">
								<h6 class="mb-0"><a class="bg_brown d-inline-block px-3 pt-2 pb-2 text-white font_14 rounded-3" href="#"> <i class="fa fa-buysellads"></i>groMate</a></h6>
							</div>
						</div>
						<div class="course_3im2 p-3 shadow_box">
						<h6><img src="../img/8.jpg" class="rounded-circle me-2" alt="abc"> <?php echo $rowFetch['farmer_name']; ?></h6>
						<h5 class="mt-3 mb-3"><a href="#"><?php echo $rowFetch['product_name']; ?></a></h5>
						<p class="mt-3 text-secondary"><?php echo $rowFetch['product_description']; ?> </p>
						
						<span class="col_yell me-3">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</span>
						
						<hr>
						<h6 class="font_14 fw-bold mb-2"> <span class="text-decoration-line-through text-muted mx-2">FCFA10,000/hr</span> <span class="col_brown"><?php echo$rowFetch['product_price']." FCFA"; ?></span></h6>
						<h6 class="mb-0"><button class="btn btn-danger d-inline-block px-3 pt-2 pb-2 text-white font_14 rounded-3" onclick="removeSavedProduct(<?php echo $row['id']; ?>)"> Remove From Saved</button></h6>
					</div>
				</div>
			</div>
		</div>
    </div>   
</div>
   </div>

		<?php		
		}
	?>
		</div>
   
   	
	</div>

	
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function removeSavedProduct(savedProductId) {
  if (confirm("Are you sure you want to remove this product from saved items?")) {
    $.ajax({
      type: "POST",
      url: "remove_saved_product.php",
      data: { saved_product_id: savedProductId },
      success: function(data) {
        alert("Product removed from saved items.");
        // Reload the saved products page
        location.reload();
      },
      error: function(xhr, status, error) {
        alert("An error occurred while removing the product.");
      }
    });
  }
}
</script>
    </body>
<html>
