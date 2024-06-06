<?php 

session_start();

if( !empty($_SESSION['cart'])) {

    //let user in 

    
    // send user back to previous page
} else {

    header('location: shop.php');
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
    <section >
        <div class="user-container">
            <h2>Check Out</h2>
            <hr>
        </div>

        <div id="checkout-form">
            <form method="POST" action="server/place_order.php">            
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="" name="name" id="checkout-name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="" name="email" id="checkout-email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" class="" name="phone" id="checkout-phone" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="" name="city" id="checkout-city" placeholder="City" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="" name="address" id="checkout-address" placeholder="Address" required>
                </div>
                <p style="color: red;">Total amount: R <?php echo $_SESSION['total']?></p>
                <input type="submit" class="btn" name="place_order" id="checkout-btn" value="Place Order"/>

            </form>
        </div>
    </section>

    <footer></footer>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
</body>
</html>