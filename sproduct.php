
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


</head>

<body >
   <header></header>
   
   <?php while($row = $product ->fetch_assoc()) { ?>

         <section id="prodetails" class="section-p1">
             <div class="pro-single-product">
                
                 <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" width="100%" id="mainimg" alt="<?php echo $row['product_name']; ?>">           
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">                
                    </div>
                    <div class="small-img-col">
                        <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image2']; ?>" alt="<?php echo $row['product_name']; ?>">                
                    </div>
                    <div class="small-img-col">
                        <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image3']; ?>" alt="<?php echo $row['product_name']; ?>">                
                    </div>
                    <div class="small-img-col">
                        <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image4']; ?>" alt="<?php echo $row['product_name']; ?>">                 
                    </div>
                </div>            
              
              
                 <div class="single-pro-details">
                     <h6> </h6>
                     <h4><?php echo $row['product_category']; ?></h4>
                     <h2><?php echo $row['product_name'];?></h2>
                     <h4>Price: R <?php echo $row['product_price']; ?></h4>
                     <span><?php echo $row['product_description']; ?></span>
                     <input type="number" value="1">
                     <button class="btn">add to cart</button>
                 </div>
             </div>

             
         </section>
    <?php } ?>     
   
         <section id="product1" class="section-p1">
        <h2>Similar Products</h2>
        <p>Have a gander at something else that might catch your interest</p>
            <div class="pro-container">
            
                <?php include('server/get_featured_products.php') ?>
    
                <?php while($row = $featured_products->fetch_assoc()){ ?>
    
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