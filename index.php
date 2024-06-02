<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukkies Tools website</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" /> 
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/mediaqueries.css">
    
</head>

<body >
    <header></header>
    
    <section id="hero">
       <h4>Welcome to Tukkies Tools</h4>
       <h2>Find the tools you need for your practicals</h2>
       <h1>cant find your stuff?</h1>
       <p>let us know</p>
       <form action="shop.html"> 
        <button class="button">Shopping</button>
       </form>      
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src= "assets/images/website-assets/shipping.png" alt="Free shipping icon">
            <h6>Free shipping</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/website-assets/Quality.png">
            <h6>Quality Items</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/website-assets/online_order.png">
            <h6>Order Online</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/website-assets/support.png">
            <h6>24/7 Support</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/website-assets/ordertrack.png">
            <h6>Tracking</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/website-assets/customorder.png">
            <h6>Custom orders</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Tools often purchased</p>
        <div class="pro-container">
        
            <?php include('server/get_featured_products.php') ?>

            <?php while($row = $featured_products->fetch_assoc()){ ?>

                <div class="pro" onclick="window.location.href='sproduct.php';">
                   <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                   <div class="des">
                        <span><?php echo $row['product_category']; ?></span>
                        <h5><?php echo $row['product_name']; ?></h5>
                        <h4>R <?php echo $row['product_price']; ?> </h4>
                   </div>
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                </div>
            <?php } ?>

        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Have a Look at</h4>
        <h2>Our <span>Specials</span> and <span>Combos</span> today!</h2>
        <button class="btn">Explore</button>

    </section>
    
    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Some of the latest Items</p>
        <div class="pro-container">

        <?php include('server/get_featured_products.php') ?>

        <?php while($row = $featured_products->fetch_assoc()){ ?>

           <div class="pro" onclick="window.location.href='sproduct.html';">
               <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
               <div class="des">
                    <span><?php echo $row['product_category']; ?></span>
                    <h5><?php echo $row['product_name']; ?></h5>
                    <h4>R <?php echo $row['product_price']; ?> </h4>
             </div>
              <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
           </div>
        <?php } ?>
               
     </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>High School Students</h4>
            <h2> Typical range of items for projects</h2>
            <span>Where the interests begin</span>
            <button class="btn">Explore</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Univeristy Students</h4>
            <h2>Typical range of items for practicals</h2>
            <span>Where the journey begins</span>
            <button class="btn">Explore</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>Technology </h2>
            <h3>components</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>Wood working</h2>
            <h3>accessories</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Art studio</h2>
            <h3>Supplies
            </h3>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Want to be kept updated with whats happening?</h4>
            <p>Sign Up <span>TODAY!</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="btn" >Sign up</button>
        </div>

    </section>

    <footer></footer>


    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
    <script src="assets/js/test.js"></script>
    
</body>

</html> 