<?php 
include('server/connection.php');

$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;

// Set the number of records per page
$total_records_per_page = 8;
$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

if(isset($_POST['category']) && $_POST['category'] != 'All') {
    $category = $_POST['category'];
    $price = $_POST['price'] ?? 10000;

    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE product_category=? AND product_price <=?");
    $stmt1->bind_param('si', $category, $price);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price <=? LIMIT ?, ?");
    $stmt2->bind_param("siii", $category, $price, $offset, $total_records_per_page);
    $stmt2->execute();
    $all_products = $stmt2->get_result();
} else {
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
    $stmt2->bind_param("ii", $offset, $total_records_per_page);
    $stmt2->execute();
    $all_products = $stmt2->get_result();
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

    <section id="shoppage-header" class="shop-header">
       <h2>Have a look around</h2>
       <p>or search for a something specific</p>    
    </section>
    
    <section id="product1" class="section-p1">
        <aside style="float: left">    
            <form action="shop.php" method="POST">
                <div>
                    <div>
                        <p>Category</p>
                        <div>
                            <input type="radio" name="category" id="category_1" value="All" <?php if(isset($category) && $category== 'All'){echo 'checked';}?>>
                            <label for="">All Items</label>   
                        </div>
                        <div>
                            <input type="radio" name="category" id="category_1" value="electronics" <?php if(isset($category) && $category== 'electronics'){echo 'checked';}?>>
                            <label for="">Electronics</label>    
                        </div>

                        <div>
                            <input type="radio" name="category" id="category_1" value="art" <?php if(isset($category) && $category== 'art'){echo 'checked';}?>>
                            <label for="">Art</label>   
                        </div>
                        
                        <div>
                            <input type="radio" name="category" id="category_1" value="tools" <?php if(isset($category) && $category== 'tools'){echo 'checked';}?>>
                            <label for="">Tools</label>   
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                        <p>Price Range:</p>
                        <input type="range" name="price" value="<?php if(isset($price)) { echo $price; } else { echo "200"; } ?>" min="1" max="10000" id="">
                        <div>
                            <span>R 1</span>
                            <span>R 10000</span>
                        </div>
                    </div>
                </div>

                <input type="submit" name="search" value="Search" class="btn" >

            </form>
        </aside>

        <div class="pro-container">

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

    <section id="pagination" class="section-p1">
        <?php if ($page_no > 1) { ?>
            <a class="btn" href="?page_no=<?php echo $previous_page; ?>">Previous</a>
        <?php } ?>

        <?php
        if ($page_no == 1) {
            echo '<a class="btn" href="?page_no=1" class="active">1</a>';
            echo '<a class="btn" href="?page_no=2">2</a>';
        } else {
            echo '<a class="btn" href="?page_no=1">1</a>';
            echo '<a class="btn" href="?page_no=2" class="active">2</a>';
        }
        ?>

        <?php if ($page_no < $total_no_of_pages) { ?>
            <a class="btn" href="?page_no=<?php echo $next_page; ?>">Next</a>
        <?php } ?>
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