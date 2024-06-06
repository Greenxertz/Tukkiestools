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
if(!isset($_POST['add_to_cart'])){
    $_SESSION['cart'] = array();
    calculateTotalCart();
    
}elseif(isset($_POST['add_to_cart'])){

    // if user added an item previously
    if(isset($_SESSION['cart'])){

        $product_array_ids = array_column($_SESSION['cart'], "product_id");
        
        if(!in_array($_POST['product_id'],$product_array_ids)) {

            $product_id = $_POST['product_id'];

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
            echo '<script>alert("Product is already in the cart.");</script>';
            echo '<script>window.location = "cart.php";</script>';
        }

    // if this is the first product 
    } else {
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity'], 
            'product_category' => $_POST['product_category']
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    }
    //update total
    calculateTotalCart();

    //Remove items from cart
} elseif (isset($_POST['remove_product'])) {
    
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalCart();

} elseif (isset($_POST['edit_quantity'])) {
    
    //receive details
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    
    //pull array from session
    $product_array = $_SESSION['cart'][$product_id];

    //update quantity in array
    $product_array['product_quantity'] = $product_quantity;

    //return array to session
    $_SESSION['cart'][$product_id] = $product_array;
    calculateTotalCart();
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

    <section id="page-header" class="cart-header">
        <h2>Thanks for shopping with us</h2>
        <p>We hope you found everything you needed</p>      
     </section>

     <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Items</td>
                    <td>quantity</td>
                    <td>SubTotal</td>
                </tr>
            </thead>
            <tbody>

            <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td>
                        <div>
                            <img src="assets/images/Shop-images/<?php echo  $value['product_category'];?>/<?php echo  $value['product_image'];?>" alt="">
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
                            <input type="number" name="product_quantity" value="<?php echo  $value['product_quantity'];?>" min="1"/>
                            <input type="submit" class="btn" value="Edit" name="edit_quantity"/>
                        </form>
                    </td>              

                    <td>
                        <span>R</span>
                        <span><?php echo  $value['product_quantity'] * $value['product_price'];?></span>
                    </td>
                </tr>
                <?php }?>
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
                    <td>shipping</td>
                    <td>free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>R <?php echo $_SESSION['total']; ?></strong></td>
                </tr>
            </table>
            <form method="POST" action="checkout.php">
                <input type="submit" class="btn" value="Proceed to checkout" name="checkout"/>
            </form>
            
        </div>
     </section>

<footer></footer>


<script>
    function validateQuantityInput(event) {
        var input = event.target.querySelector('input[name="product_quantity"]');
        if (input.value === '' || input.value <= 0) {
            alert('Please enter a valid quantity.');
            event.preventDefault();
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