<?php 
include('server/connection.php');

$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;

// Set the number of records per page
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

if(isset($_POST['category']) && $_POST['category'] != 'All') {
    $category = $_POST['category'];
    $price = $_POST['price'] ?? 1000;

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


<?php include('header.php'); ?>

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
                        <div class="searchbar">
                            <div>
                                <input type="radio" name="category" id="category_all" value="All" <?php if(isset($category) && $category== 'All'){echo 'checked';}?>>
                                <label for="category_all">All Items</label>   
                            </div>
                            <div>
                                <input type="radio" name="category" id="category_electronics" value="electronics" <?php if(isset($category) && $category== 'electronics'){echo 'checked';}?>>
                                <label for="category_electronics">Electronics</label>    
                            </div>

                            <div>
                                <input type="radio" name="category" id="category_art" value="art" <?php if(isset($category) && $category== 'art'){echo 'checked';}?>>
                                <label for="category_art">Art</label>   
                            </div>
                            
                            <div>
                                <input type="radio" name="category" id="category_tools" value="tools" <?php if(isset($category) && $category== 'tools'){echo 'checked';}?>>
                                <label for="category_tools">Tools</label>   
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                    <p>Price Range:</p>
                    <input type="range" name="price" value="<?php echo isset($price) ? $price : '500'; ?>" min="1" max="1000" id="priceRange" oninput="updateRangeValue(this.value)">
                    <div class="pricerange">
                        <span>R 1</span>
                        <span style="color: white;"id="currentPrice">R <?php echo isset($price) ? $price : '500'; ?></span>
                        <span>R 1000</span>
                    </div>
                    </div>
                </div>

                <input type="submit" name="search" value="Search" class="btn" >
            </form>
        </aside>
        <div class="pro-container">
            <?php if($all_products->num_rows > 0) { ?>
                <?php while($row = $all_products->fetch_assoc()) { ?>
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
                
            <?php } else {?>
            <div class="no-products">
                    <p>No products found matching your criteria.</p>
                </div>
                 <?php } ?>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <?php
            $adjacents = 2; // Number of adjacent pages on each side
            $start = ($page_no > $adjacents) ? $page_no - $adjacents : 1;
            $end = ($page_no + $adjacents < $total_no_of_pages) ? $page_no + $adjacents : $total_no_of_pages;

            if ($page_no > 1) {
                echo '<a class="btn" href="?page_no=' . $previous_page . '">Previous</a>';
            }

            if ($start > 1) {
                echo '<a class="btn" href="?page_no=1">1</a>';
                if ($start > 2) {
                    echo '<span>...</span>';
                }
            }

            for ($i = $start; $i <= $end; $i++) {
                if ($i == $page_no) {
                    echo "<a class='btn active' href='?page_no=$i'>$i</a>";
                } else {
                    echo "<a class='btn' href='?page_no=$i'>$i</a>";
                }
            }

            if ($end < $total_no_of_pages) {
                if ($end < $total_no_of_pages - 1) {
                    echo '<span>...</span>';
                }
                echo '<a class="btn" href="?page_no=' . $total_no_of_pages . '">' . $total_no_of_pages . '</a>';
            }

            if ($page_no < $total_no_of_pages) {
                echo '<a class="btn" href="?page_no=' . $next_page . '">Next</a>';
            }
        ?>
    </section>

    <script>
        function updateRangeValue(value) {
            document.getElementById('currentPrice').innerText = 'R ' + value;
        }
            document.getElementById('priceRange').addEventListener('input', function() {
             updateRangeValue(this.value);
        });
        function updateRangeValue(value) {
            document.getElementById('rangeValue').textContent = value;
        }
    </script>
<?php include('footer.php'); ?>