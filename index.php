<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukkies Tools website</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" /> 
    <link rel="stylesheet" href="assets/css/styles.css">
    
</head>

<body >
    <section id="header">
        <a href="#"><img src= "assets/images/logo.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li id="lg-bag"><a href="cart.html"><i class="far fa-shopping-cart"></i></a></li>
                <li><a href="user.html"><i class="far fa-user"></i></a></li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile"> 
            <a href="shoppingcart.html"><i class="far fa-shopping-cart"></i></a>
            <i id="bar" class="fas fa-outdent"> </i>
        </div>
    </section>
   
    <section id="hero">
       <h4>Welcome to Tukkies Tools</h4>
       <h2>Find the tools you need for your practicals</h2>
       <h1>cant find your stuff?</h1>
       <p>let us know</p>
       <button>Shopping</button>       
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src= "assets/images/shipping.png" alt="Free shipping icon">
            <h6>Free shipping</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/Quality.png">
            <h6>Quality Items</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/online_order.png">
            <h6>Order Online</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/support.png">
            <h6>24/7 Support</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/ordertrack.png">
            <h6>Tracking</h6>
        </div>
        <div class="fe-box">
            <img src= "assets/images/customorder.png">
            <h6>Custom orders</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Tools often purchased</p>
        <div class="pro-container">
        
            <?php include('server/get_featured_products.php') ?>

            <?php while($row = $featured_products->fetch_assoc()){ ?>

                <div class="pro" onclick="window.location.href='sproduct.html';">
                   <img src="assets/images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
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
        <button class="normal">Explore</button>

    </section>
    
    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Some of the latest Items</p>
        <div class="pro-container">

        <?php include('server/get_featured_products.php') ?>

        <?php while($row = $featured_products->fetch_assoc()){ ?>

           <div class="pro" onclick="window.location.href='sproduct.html';">
               <img src="assets/images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
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
            <button class="white">Explore</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Univeristy Students</h4>
            <h2>Typical range of items for practicals</h2>
            <span>Where the journey begins</span>
            <button class="white">Explore</button>
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
            <button class="normal" >Sign up</button>
        </div>

    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src= "assets/images/logo.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong> 123 fakestreet Cape town South Africa</p>
            <p><strong>Phone: </strong> (+27) 76 123 1245 / (+27) 76 123 1456 </p>
            <p><strong>Hours: </strong> 10:00 - 17:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest"></i>
                    <i class="fab fa-youtube"></i>
                </div>    
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms and Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From Appstore or Google Play</p>
            <div class="row">
                <img src= "assets/images/store_images/app.jpg" alt="">
                <img src= "assets/images/store_images/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateways</p>
            <img src= "assets/images/store_images/pay.png" alt="">
        </div>

        <div class="copyright"> 
            <p>Copyright © 2024 - Greenxertz.co.za | ITECA Project</p>
        </div>

    </footer>

    <script src="assets/js/script.js"></script>
    
</body>

</html> 