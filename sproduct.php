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
   
    <section id="prodetails" class="section-p1">
        <div class="pro-single-product">
            <img src="" width="100%" id="mainimg" alt="">
            <div class="single-pro-details">
                <h6></h6>
                <h4></h4>
                <h2></h2>
                <select>
                     <option>

                    </option>
                </select>
                <input type="number" value="1">
                <button class="normal">add to cart</button>
                <h4></h4>
                <span></span>

            </div>
        </div>

        <div class="small-img-group">
            <div class="small-img-col">
                <img src=""  width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src=""  width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src=""  width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src=""  width="100%" class="small-img" alt="">
            </div>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Similar Products</h2>
        <p>Have a gander at something else that might catch your interest</p>
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

    

    <footer></footer>

    <script>
        var mainimg = document.getElementById("mainimg");
        var smallimg = document.getElementsByClassName("small-img");

        smallimg[0].onclick = function(){
            mainimg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function(){
            mainimg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function(){
            mainimg.src = smallimg[2].src;
        }
        smallimg[3].onclick = function(){
            mainimg.src = smallimg[3].src;
        }
    </script>

<script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
    
</body>

</html> 