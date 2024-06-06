
<?php 

include('server/connection.php');

$product = null; // Initialize the product variable

if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $product = $stmt->get_result();

            if ($product->num_rows == 0) {
                // No product found, redirect to index
                 header('Location: index.php');
                 exit();
            }
        } else {
            echo "Failed to prepare the SQL statement.";
            exit();
        }
    } else {
        echo "Failed to connect to the database.";
        exit();
    }

} else {
    // Redirect if product_id is not set
     header('Location: index.php');
     exit();
}

?>

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
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/website-assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/website-assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/website-assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/images/website-assets/favicon_io/site.webmanifest">


</head>

<body >
   <header></header>
   
   <?php while($row = $product ->fetch_assoc()) { ?>

    <section id="prodetails" class="section-p1">
    <div class="pro-single-product">
        <div class="image-gallery">
            <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" width="100%" id="mainimg" alt="<?php echo $row['product_name']; ?>">           
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" width="100%" id="smllimg" alt="<?php echo $row['product_name']; ?>">                
                </div>
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image2']; ?>" width="100%" id="smllnimg" alt="<?php echo $row['product_name']; ?>">                
                </div>
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image3']; ?>" width="100%" id="smllnimg" alt="<?php echo $row['product_name']; ?>">                
                </div>
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image4']; ?>" width="100%" id="smllnimg" alt="<?php echo $row['product_name']; ?>">                 
                </div>
            </div>
        </div>

        <div class="details-section">
            <h4><?php echo $row['product_category']; ?></h4>
            <?php $current_product_category = $row['product_category'];?>
            <h2><?php echo $row['product_name']; ?></h2>
            <h3><?php echo $row['product_description']; ?></h3>
            <h4>Price: R <?php echo $row['product_price']; ?></h4>
            <span><?php echo $row['product_description']; ?></span>

            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                <input type="hidden" name="product_category" value="<?php echo $row['product_category']; ?>">

                <input type="number" name="product_quantity" value="1">
                <button class="btn" type="submit" name="add_to_cart">Add to cart</button>
            </form>
        </div>
    </div>
</section>
    <?php } ?>     
   
         <section id="product1" class="section-p1">
        <h2>Similar Products</h2>
        <p>Have a gander at something else that might catch your interest</p>
            <div class="pro-container">
            
                <?php include('server/similar_products.php') ?>
    
                <?php while($row = $similar_products->fetch_assoc()){ ?>
    
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


    
   
    <footer></footer>

    <script>
        var mainimg = document.getElementById("mainimg");
        var smallimgs = document.querySelectorAll(".small-img-col img");

        smallimgs.forEach(function(smallimg, index) {
            smallimg.onclick = function() {
                mainimg.src = this.src;
            };
      });
    </script>

<script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
    
</body>

</html> 