<?php 
session_start();

function calculateTotalCart(){
    $total = 0;
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $key => $value) {
            $price = $value['product_price'];
            $quantity = $value['product_quantity'];
            $total += ($price * $quantity);
        }
    }
    $_SESSION['total'] = $total;
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['total'] = 0;
   
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $product_array_ids = array_column($_SESSION['cart'], "product_id");
    
    if (!in_array($_POST['product_id'], $product_array_ids)) {
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity'],
            'product_category' => $_POST['product_category']
        );
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    } else {
        // Feedback for already added product
        echo "<script>alert('Product is already in the cart.');</script>";
    }
    calculateTotalCart();
}

// Remove from cart
if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalCart();
}

// Edit quantity
if (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    
    if ($product_quantity > 0) {
        $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
        calculateTotalCart();
    } else {
        echo "<script>alert('Quantity must be a positive number.');</script>";
    }
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
<body>
    <header></header>
    <section id="page-header" class="cart-header">
        <h2>Thanks for shopping with us</h2>
        <p>We hope you found everything you needed</p>
    </section>
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Items</td>
                    <td>Quantity</td>
                    <td>SubTotal</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td>
                        <div>
                            <img src="assets/images/Shop-images/<?php echo  $value['product_image'];?>" alt="">
                            <div>
                                <p><?php echo  $value['product_name'];?></p>
                                <small><span>R</span><?php echo  $value['product_price'];?></small>
                                <br>
                                <form method="POST" action="cart.php" name="cart-form">
                                    <input type="hidden" name="product_id" value="<?php echo  $value['product_id'];?>">
                                    <input type="submit" name="remove_product" class="btn" value="Remove"/>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo  $value['product_id'];?>"/>
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" min="1" onchange="validateQuantityInput(event)" />
                            <input type="submit" class="btn" value="Edit" name="edit_quantity"/>
                        </form>
                    </td>              
                    <td>
                        <span>R</span>
                        <span><?php echo  $value['product_quantity'] * $value['product_price'];?></span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
    <section id="cart-add" class="section-p1">
        <div id="subtotal">
            <h3>Cart Total</h3>
            <table>
                <tr>
                    <td>Cart Total</td>
                    <td>R <?php echo $_SESSION['total']; ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>R <?php echo $_SESSION['total']; ?></strong></td>
                </tr>
            </table>
            <div style="margin-bottom: 5px;">
                <input type="button" class="btn" value="Continue Shopping" onclick="window.location.href='shop.php'"/>
            </div>
            <form method="POST" action="checkout.php">
                <input type="submit" class="btn" value="Proceed to checkout" name="checkout"/>
            </form>
        </div>
    </section>
    <footer></footer>

    <script>
   function validateQuantityInput(event) {
        var input = event.target;
        if (input.value === '' || input.value <= 0 || input.value.trim() === '') {
            alert('Please enter a valid quantity.');
            input.value = 1; // Reset to a default valid value if invalid input
        }
    }
        document.querySelectorAll('form[name="cart-form"]').forEach(function(form) {
            form.addEventListener('submit', validateQuantityInput);
        });
    </script>

    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
</body>
</html>
