<?php
    session_start();
    if($_SESSION['farmerLogged']!=true){
        header("Location: login.php?msg=No Session Exist!");
        die();
        
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Farmer Dashboard</title>
        
		<link href="../css/dashboard.css" rel="stylesheet" type="text/css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
       
        <!------ Include the above in your HEAD tag ---------->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

		    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src='https://use.fontawesome.com/releases/v5.0.8/js/all.js'></script>	
    
        <style>
        a{
            text-decoration: none;
        }
        a:hover{
            text-decoration: none;
        }
        .card-counter{
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height: 100px;
        border-radius: 5px;
        transition: .3s linear all;
      }
    
      .card-counter:hover{
        box-shadow: 4px 4px 20px #DADADA;
        transition: .3s linear all;
      }
    
      .card-counter.primary{
        background-color: #007bff;
        color: #FFF;
      }
    
      .card-counter.danger{
        background-color: #ef5350;
        color: #FFF;
      }  
    
      .card-counter.success{
        background-color: #66bb6a;
        color: #FFF;
      }  
    
      .card-counter.info{
        background-color: #26c6da;
        color: #FFF;
      }  
    
      .card-counter i{
        font-size: 5em;
        opacity: 0.2;
      }
    
      .card-counter .count-numbers{
        position: absolute;
        right: 35px;
        top: 20px;
        font-size: 32px;
        display: block;
      }
    
      .card-counter .count-name{
        position: absolute;
        right: 35px;
        top: 65px;
        font-style: italic;
        text-transform: capitalize;
        opacity: 0.5;
        display: block;
        font-size: 18px;
      }
        </style>
	</head>

    <body class="sidebar-is-reduced bg-primary">
    <?php
        include('../includes/autoloader1.inc.php');

        $farmer = new Farmers;
        $result = $farmer->getFarmer($_SESSION['farmer_email']);
        $row = mysqli_fetch_assoc($result);
        
    ?>
    <header class="l-header">
      <div class="l-header__inner clearfix">
        <div class="c-header-icon js-hamburger">
          <div class="hamburger-toggle"><span class="bar-top"></span><span class="bar-mid"></span><span class="bar-bot"></span></div>
        </div>
        <div class="c-header-icon has-dropdown">
            <a href="profile.php?id=<?php echo $_SESSION['farmer_id']; ?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                  <div class="c-dropdown c-dropdown--notifications">
                    <div class="c-dropdown__header"></div>
                    <div class="c-dropdown__content"></div>
                  </div>
            </a>
        </div>
       
        <div class="c-search">
          <input class="c-search__input u-input" placeholder="Search..." type="text"/>
        </div>
        <div class="c-header-icon has-dropdown">
            <a href="">
                <i class="fa fa-search" aria-hidden="true"></i>
                  <div class="c-dropdown c-dropdown--notifications">
                    <div class="c-dropdown__header"></div>
                    <div class="c-dropdown__content"></div>
                  </div>
            </a>
        </div>
        
        <div class="header-icons-group">
          <a href="messaging.php">
            <div class="c-header-icon basket"><span class="c-badge c-badge--blue c-badge--header-icon animated swing">New</span><i class="fa fa-envelope"></i></div>
          </a>
            <div class="c-header-icon logout">
              <form action="includes/logout.inc.php" method="post" class="c-header-icon logout">
                <button class="c-header-icon logout" type="submit" name="logout-submit" style="border:none;"><a href="#"><i class="fa fa-power-off"></i></a></button>  
              </form>
            </div>
        </div>
      </div>
    </header>
    <div class="l-sidebar">
      <div class="logo">
        <div class="logo__txt">A</div>
      </div>
      <div class="l-sidebar__content">
        <nav class="c-menu js-menu">
          <ul class="u-list">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="My Products">
              <a href="products.php">
                    <div class="c-menu__item__inner"><i class="fa fa-calendar" aria-hidden="true"></i>
                    <div class="c-menu-item__title"><span>My Products</span></div>
                    </div>
              </a>
            </li>
           
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Other Products">
              <a href="all_products.php">
                    <div class="c-menu__item__inner"><i class="fa fa-user" aria-hidden="true"></i>
                    <div class="c-menu-item__title"><span>Other Products</span></div>
                    </div>
              </a>
            </li>
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Chats">
              <a href="messaging.php">
                    <div class="c-menu__item__inner"><i class="fa fa-envelope" aria-hidden="true"></i>
                    <div class="c-menu-item__title"><span>Chats</span></div>
                    </div>
              </a>
            </li>
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Ratings">
                <a href="ratings.php">
                    <div class="c-menu__item__inner"><i class="far fa-chart-bar"></i>
                    <div class="c-menu-item__title"><span>Ratings</span></div>
                    </div>
                </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </body>
  <main class="l-main">
    <div class="content-wrapper content-wrapper--with-bg">
      <h1 class="page-title" style="color:chartreuse;">Farmer Dashboard</h1>
      <div class="page-content">Welcome back <em style="font-size: 22px; color: chartreuse;"><?php echo ucfirst($row['farmer_name']);?>!</em></div>
      
      <?php
            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                echo '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        ?>
      
      <div class="container mt-3">
            <div class="row mt-4 mb-4">
                <div class="col-md-3">
                  <div class="card-counter primary">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  <?php
                  $product = new Products();
                  $result = $product->countProducts($_SESSION['farmer_name']);
                  ?>
                    <span class="count-numbers"><?php echo $result; ?></span>
                    <span class="count-name">Products</span>
                  </div>
                </div>
            
                <div class="col-md-3">
                  <div class="card-counter danger">
                  <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="count-numbers">4</span>
                    <span class="count-name">Farmers</span>
                  </div>
                </div>
            
                <div class="col-md-3">
                  <div class="card-counter success">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span class="count-numbers">8</span>
                    <span class="count-name">Messages</span>
                  </div>
                </div>
            
                <div class="col-md-3">
                  <div class="card-counter info">
                    <i class="far fa-chart-bar"></i>
                    <span class="count-numbers">4</span>
                    <span class="count-name">Ratings</span>
                 </div>
                </div>
        </div>

      <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#00ff5573;">
            View All Your Data Records!

            
      </nav>
      <a href="add_product.php">
      <div class="col-md-3">
        <div class="card-counter alert">
          <span class="count-numbers text-center">Click</span>
          <span class="count-name">To Add Products</span>
        </div>
      </div>
      </a>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
   
   <script>
       let Dashboard = (() => {
   let global = {
     tooltipOptions: {
       placement: "right" },
 
     menuClass: ".c-menu" };
 
 
   let menuChangeActive = el => {
     let hasSubmenu = $(el).hasClass("has-submenu");
     $(global.menuClass + " .is-active").removeClass("is-active");
     $(el).addClass("is-active");
 
     // if (hasSubmenu) {
     // 	$(el).find("ul").slideDown();
     // }
   };
 
   let sidebarChangeWidth = () => {
     let $menuItemsTitle = $("li .menu-item__title");
 
     $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
     $(".hamburger-toggle").toggleClass("is-opened");
 
     if ($("body").hasClass("sidebar-is-expanded")) {
       $('[data-toggle="tooltip"]').tooltip("destroy");
     } else {
       $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
     }
 
   };
 
   return {
     init: () => {
       $(".js-hamburger").on("click", sidebarChangeWidth);
 
       $(".js-menu li").on("click", e => {
         menuChangeActive(e.currentTarget);
       });
 
       $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
     } };
 
 })();
 
 Dashboard.init();
   </script>
 
</body>
 </html>