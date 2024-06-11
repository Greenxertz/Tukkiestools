
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

<?php include('header.php'); ?>
   
   <?php while($row = $product ->fetch_assoc()) { ?>

    <section id="prodetails" class="section-p1">
    <div class="pro-single-product">
        <div class="image-gallery">
            <img src="assets/images/Shop-images/<?php echo $row['product_image1']; ?>" width="100%" id="mainimg" alt="<?php echo $row['product_name']; ?>">           
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_image1']; ?>" width="100%" id="smllimg" alt="<?php echo $row['product_name']; ?>">                
                </div>
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_image2']; ?>" width="100%" id="smllnimg" alt="<?php echo $row['product_name']; ?>">                
                </div>
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_image3']; ?>" width="100%" id="smllnimg" alt="<?php echo $row['product_name']; ?>">                
                </div>
                <div class="small-img-col">
                    <img src="assets/images/Shop-images/<?php echo $row['product_image4']; ?>" width="100%" id="smllnimg" alt="<?php echo $row['product_name']; ?>">                 
                </div>
            </div>
        </div>

        <div class="details-section">
            <h4><?php echo $row['product_category']; ?></h4>
            <?php $current_product_category = $row['product_category'];?>
            <h2><?php echo $row['product_name']; ?></h2>
            <span><?php echo $row['product_description']; ?></span>
            <h4>Price: R <?php echo $row['product_price']; ?></h4>

            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image1']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                <input type="hidden" name="product_category" value="<?php echo $row['product_category']; ?>">
                <input type="number" name="product_quantity" value="1" min="1" onchange="validateQuantityInput(event)" />

                <button class="btn" type="submit" name="add_to_cart">Add to cart</button>
            </form>
        </div>
    </div>
</section>
    <?php } ?>     
   
        <section id="product1" class="section-p1">
        <hr>
        <h2>Similar Products</h2>
        <p>Have a gander at something else that might catch your interest</p>
            <div class="pro-container">
            
                <?php include('server/similar_products.php') ?>
    
                <?php while($row = $similar_products->fetch_assoc()){ ?>
    
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


    
   

    <script>

    function validateQuantityInput(event) {
        var input = event.target;
        if (input.value === '' || input.value <= 0 || input.value.trim() === '') {
            alert('Please enter a valid quantity.');
            input.value = 1; // Reset to a default valid value if invalid input
        }
    }

        var mainimg = document.getElementById("mainimg");
        var smallimgs = document.querySelectorAll(".small-img-col img");

        smallimgs.forEach(function(smallimg, index) {
            smallimg.onclick = function() {
                mainimg.src = this.src;
            };
      });
    </script>

<?php include('footer.php'); ?>