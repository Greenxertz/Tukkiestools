
<?php include('header.php'); ?>
    
    <section id="hero">
       <h4>Welcome to Tukkies Tools</h4>
       <h2>Find the tools you need for your practicals</h2>
       <h1>cant find your stuff?</h1>
       <p>let us know</p>
       <form action="shop.php"> 
        <button class="btn">Shopping</button>
       </form> 
    </section>

     <section>
       <div id="cube-container">
        <div id="cube">
            <div class="face front"><img src="assets/images/website-assets/logo.png"></div>
            <div class="face back"><img src="assets/images/website-assets/logo.png"></div>
            <div class="face left"><img src="assets/images/website-assets/logo.png"></div>
            <div class="face right"><img src="assets/images/website-assets/logo.png"></div>
            <div class="face top"><img src="assets/images/website-assets/logo.png"></div>
            <div class="face bottom"><img src="assets/images/website-assets/logo.png"></div>
        </div>
    </div>

    <script src='assets/js/cube.js'></script>
    
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

                   <div class="card-container">
                    <div class="card" onclick="window.location.href='<?php echo "sproduct.php?product_id=". $row['product_id'];?>';">
                        <div class="card-inner">
                            <div class="card-front">
                            <img src="assets/images/Shop-images/<?php echo $row['product_image1']; ?>" alt="<?php echo $row['product_name']; ?>">
                            </div>
                            <div class="card-back">
                                <img src="assets/images/Shop-images/<?php echo $row['product_image1']; ?>" alt="<?php echo $row['product_name']; ?>">
                                <div class="card-back-content">
                                    <span><?php echo $row['product_category']; ?></span>
                                    <h5><?php echo $row['product_name']; ?></h5>
                                    <h4>R <?php echo $row['product_price']; ?> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Have a Look at</h4>
        <h2 style="font-size: 20px;">Our <span style="font-size: 30px; color:white;">Specials</span> and <span style="font-size: 30px;color:white;">Combos</span> today!</h2>
        <button class="btn">Explore</button>

    </section>
    
    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Some of the latest Items</p>
        <div class="pro-container">

            <?php include('server/new_arrivals.php') ?>

            <?php while($row = $new_products->fetch_assoc()){ ?>

               <div class="card-container">
                    <div class="card" onclick="window.location.href='<?php echo "sproduct.php?product_id=". $row['product_id'];?>';">
                        <div class="card-inner">
                            <div class="card-front">
                            <img src="assets/images/Shop-images/<?php echo $row['product_image1']; ?>" alt="<?php echo $row['product_name']; ?>">
                            </div>
                            <div class="card-back">
                                <img src="assets/images/Shop-images/<?php echo $row['product_image1']; ?>" alt="<?php echo $row['product_name']; ?>">
                                <div class="card-back-content">
                                    <span><?php echo $row['product_category']; ?></span>
                                    <h5><?php echo $row['product_name']; ?></h5>
                                    <h4>R <?php echo $row['product_price']; ?> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
               
     </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>High School Students</h4>
            <h2> Typical range of projects</h2>
            <span>Where the interests begin</span>
            <a class="btn" href="https://www.instructables.com/9-12-Projects-High-School/">Explore</a>
        </div>
        <div class="banner-box banner-box2">
            <h4>Univeristy Students</h4>
            <h2>Typical range of practicals</h2>
            <span>Where the journey begins</span>
            <a class="btn" href="https://www.guvi.in/blog/unique-project-ideas-for-college-students/">Explore</a>
        </div>
    </section>


    <h2 style="text-align: center;">Our range caters to these fields: </h2>

    <section id="banner3">   
        <div class="banner-box">
            <h2>Technology </h2>
        </div>
        <div class="banner-box banner-box2">
            <h2>Wood working</h2>
        </div>
        <div class="banner-box banner-box3">
            <h2>Art studio</h2>
        </div>
    </section>


<?php include('footer.php'); ?>





    
