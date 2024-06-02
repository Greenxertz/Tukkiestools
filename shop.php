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

    <section id="shoppage-header" class="shop-header">
       <h2>Have a look around</h2>
       <p>or search for a something specific</p>    
    </section>

    <section id="product1" class="section-p1">

        <div class="pro-container">

       <?php include('server/get_all_products.php') ?>

            <?php while($row = $all_products->fetch_assoc()){ ?>
                
                
                <div class="pro" onclick="window.location.href='<?php echo "sproduct.php?product_id=". $row['product_id'];?>';">
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

    <section id="pagination" class="section-p1 ">
        <a class="btn" href="#">1</a>
        <a class="btn" href="#">2</a>
        <a class="btn" href="#"><i class="fal fa-long-arrow-right"></i></a>
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
    
</body>

</html> 