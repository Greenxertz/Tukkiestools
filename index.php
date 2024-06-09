
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

        <script>
            let rotateX = 0;
            let rotateY = 0;
            let rotateSpeedX = 0;
            let rotateSpeedY = 0;
            let dragging = false;
            let previousMouseX;
            let previousMouseY;
            let lastMoveTimestamp;

            const cube = document.getElementById('cube');

            function applyRotation() {
                rotateX += rotateSpeedX;
                rotateY += rotateSpeedY;
                cube.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                requestAnimationFrame(applyRotation);
            }

            // Initial spin
            rotateSpeedX = 0.5; // Adjust the initial spin speed
            rotateSpeedY = 0.5; // Adjust the initial spin speed

            cube.addEventListener('mousedown', (event) => {
                dragging = true;
                rotateSpeedX = 0;
                rotateSpeedY = 0;
                previousMouseX = event.clientX;
                previousMouseY = event.clientY;
                lastMoveTimestamp = Date.now();
                cube.style.cursor = 'grabbing';
            });

            document.addEventListener('mousemove', (event) => {
                if (!dragging) return;

                const currentTime = Date.now();
                const timeElapsed = currentTime - lastMoveTimestamp;

                const deltaX = event.clientX - previousMouseX;
                const deltaY = event.clientY - previousMouseY;

                rotateSpeedX = deltaY / timeElapsed * 5;
                rotateSpeedY = deltaX / timeElapsed * 5;

                rotateX += deltaY * 0.5;
                rotateY += deltaX * 0.5;

                cube.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

                previousMouseX = event.clientX;
                previousMouseY = event.clientY;
                lastMoveTimestamp = currentTime;
            });

            document.addEventListener('mouseup', () => {
                dragging = false;
                cube.style.cursor = 'grab';
            });

            document.addEventListener('mouseleave', () => {
                dragging = false;
                cube.style.cursor = 'grab';
            });

            requestAnimationFrame(applyRotation);
        </script>
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


<?php include('footer.php'); ?>





    
