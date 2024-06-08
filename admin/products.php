<?php
session_start(); 

include('admin_header.php'); 

if(!isset($_SESSION['admin_logged_in'])) { 
    header('location: admin_login.php');
    exit;
}

$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

$total_no_of_pages = ceil($total_records / $total_records_per_page);

$stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
$stmt2->bind_param("ii", $offset, $total_records_per_page);
$stmt2->execute();
$products = $stmt2->get_result();
?>

<body>
        
    <div class="admin-container">
        <aside class="sidebar">
            <?php include('navbar.php'); ?>
        </aside>
        <main class="main-content">
            <section id="order-table">
                <h2>Products</h2>
                <?php if(isset($_GET['edit_message'])) {?>
                    <p><?php echo $_GET['edit_message'];?></p>
                <?php  } ?>
                <?php if(isset($_GET['delete_message'])) {?>
                    <p><?php echo $_GET['delete_message'];?></p>
                <?php  } ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Category</th>
                            <th>Product Special</th>
                            <th>Product Description</th>
                            <th>Product Date Added</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product) { ?>
                        <tr>
                            <td><?php echo $product['product_id']; ?></td>
                            <td><img src="../assets/images/Shop-images/<?php echo $product['product_image1']; ?>" ></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td>R <?php echo $product['product_price']; ?></td>
                            <td><?php echo $product['product_category']; ?></td>
                            <td><?php echo $product['product_special_offer']; ?></td>
                            <td><?php echo $product['product_description']; ?></td>
                            <td><?php echo $product['products_date_added']; ?></td>
                            <td><a href="edit_product.php?product_id=<?php echo $product['product_id'];?>" class="btn">Edit</a></td>
                            <td><a href="delete_product.php?product_id=<?php echo $product['product_id'];?>" class="btn">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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

        </main>
    </div>
</body>
</html>
