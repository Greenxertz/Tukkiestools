<?php

include('connection.php');

// Assuming the current product's category is stored in $current_product_category
if (isset($current_product_category)) {

    // Select similar products based on the current product's category, excluding the current product
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_id != ? LIMIT 4");

    if ($stmt) {
        $stmt->bind_param("si", $current_product_category, $product_id);
        $stmt->execute();
        $similar_products = $stmt->get_result();

    } else {
        echo "Failed to prepare the SQL statement.";
        exit();
    }

} else {
    echo "Current product category is not set.";
    exit();
}