<?php
session_start();

include('admin_header.php');

// Fetch product categories function
function getCategories($conn) {
    $categories = [];
    $stmt = $conn->prepare("SELECT DISTINCT product_category FROM products");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['product_category'];
    }
    return $categories;
}

// Handle form submission to add a new product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_special_offer = $_POST['product_special_offer'];
    $product_description = $_POST['product_description'];

    // Image upload handling
    $image_names = [];
    for ($i = 1; $i <= 4; $i++) {
        if (!empty($_FILES["product_image_$i"]["name"])) {
            $image_name = basename($_FILES["product_image_$i"]["name"]);
            $target_dir = "../assets/images/shop-images/" . $product_category . "/";
            $target_file = $target_dir . $image_name;
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
            }
            if (move_uploaded_file($_FILES["product_image_$i"]["tmp_name"], $target_file)) {
                $image_names[$i] = $image_name;
            } else {
                echo "Error uploading file.";
            }
        } else {
            $image_names[$i] = '';
        }
    }

    // Insert query with image names
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_price, product_category, product_special_offer, product_description, product_image1, product_image2, product_image3, product_image4, products_date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sdsssssss", $product_name, $product_price, $product_category, $product_special_offer, $product_description, $image_names[1], $image_names[2], $image_names[3], $image_names[4]);

    if ($stmt->execute()) {
        header('Location: products.php?add_message=Product was added successfully');
        exit;
    } else {
        header('Location: products.php?add_message=Product was added successfully');
    }
}
?>

<body>
    <div class="admin-container">
        <aside class="sidebar">
            <?php include('navbar.php'); ?>
        </aside>
        <main class="main-content">
            <section id="order-table">
                <h2>Add New Product:</h2>
                <hr>
                <form method="POST" enctype="multipart/form-data">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Category</th>
                                <th>Product Special</th>
                                <th>Product Description</th>
                                <th>Product Date Added</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="product_name" required></td>
                                <td><input type="number" step="0.01" name="product_price" required></td>
                                <td>
                                    <select name="product_category" required>
                                        <?php
                                        $categories = getCategories($conn);
                                        foreach ($categories as $category) {
                                            echo "<option value='$category'>$category</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" name="product_special_offer"></td>
                                <td><input type="text" name="product_description"></td>
                                <td>N/A</td>
                                <td><button type="submit" class="btn">Add</button></td>
                            </tr>

                            <!-- Image Rows -->
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                <tr>
                                    <td colspan="7">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <div style="text-align: left;">
                                                <label for="product_image_<?php echo $i; ?>"><?php if($i==1){echo 'Main ';} ?> Image <?php echo $i; ?>:</label> <!-- Label for image -->
                                                <input type="file" name="product_image_<?php echo $i; ?>" id="product_image_<?php echo $i; ?>" onchange="previewImage(event, <?php echo $i; ?>)">
                                            </div>                        
                                             <div style="text-align: center;">
                                                <img id="preview_<?php echo $i; ?>" src="" alt="New Product Image <?php echo $i; ?>" style="max-width: 100px;">
                                                <div id="preview_text_<?php echo $i; ?>" style="border: 1px solid #ccc; padding: 5px;"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endfor; ?>

                        </tbody>
                    </table>
                </form>
            </section>
        </main>
    </div>

    <script>
        function previewImage(event, imageNumber) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var previewImage = document.getElementById('preview_' + imageNumber);
                var previewText = document.getElementById('preview_text_' + imageNumber);
                previewImage.src = reader.result;
                previewText.textContent = input.files[0].name; // Display file name as text
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
</body>
</html>
