<?php
    require_once('includes/header.php');
?>
<section id="course" class="p_3">
 <div class="container-xl">
		<div class="row course_1">
			<div class="col-md-9">
				<div class="course_1l">
					<h3 class="mb-0">Latest Products</h3>
				</div>
			</div>

		</div>
			<?php
		require('classes/products.class.php');
		
		$product = new Products();
		$result = $product->getAllExistingProducts();

		while ($row = mysqli_fetch_assoc($result)) {
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
											<a href="product_details.php?id=<?php echo $row['product_id']; ?>"><img src="<?php echo "farmers/public/farmerProductImages/".$row['image_name']; ?>" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
								<div class="course_3im1i1 position-absolute w-100 top-0 clearfix p-3">
								<h6 class="mb-0"><a class="bg_brown d-inline-block px-3 pt-2 pb-2 text-white font_14 rounded-3" href="#"> <i class="fa fa-buysellads"></i>groMate</a></h6>
							</div>
						</div>
						<div class="course_3im2 p-3 shadow_box">
						<h6><img src="<?php echo 'farmers/public/farmerProfileImages/work-1.png'; ?>" width="35" height="35" class="rounded-circle me-2" alt="abc"> <?php echo $row['farmer_name']; ?></h6>
						<h5 class="mt-3 mb-3"><a href="#"><?php echo $row['product_name']; ?></a></h5>
						<p class="mt-3 text-secondary"><?php echo $row['product_description']; ?> </p>
						
						<span class="col_yell me-3">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</span>
						<hr>
						<h6 class="font_14 fw-bold mb-0"> <span class="text-decoration-line-through text-muted mx-2">FCFA10,000/hr</span> <span class="col_brown"><?php echo $row['product_price']." FCFA"; ?></span></h6>
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

<?php
    require_once('includes/footer.php');
?>