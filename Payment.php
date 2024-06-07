<?php
session_start();
$came_from = isset($_SESSION['came_from']) ? $_SESSION['came_from'] : 'unknown';
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
            <h2>Payment</h2>
            <hr>
        </div>
        <div id="payment-form">
            <?php echo var_dump($_SESSION); ?>
            <?php echo var_dump($_POST); ?>
            <?php if($_SESSION['came_from'] == "checkout" ) {?>

                <p>Total amount due: R<?php echo $_SESSION['total'] ?></p>
                <p>You can continue to browse and pay later via cart if you'd like.</p>
                <input class='btn' type="submit" value="Pay Now"/>

                <?php } else if($_SESSION['came_from'] == "account" && $_POST['order_status']== "not paid" ){ ?>

                <p>Total amount due: R<?php echo $_POST['order_total_price']; ?></p>
                <p>Delivery will only begin once payment has been confirmed.</p>
                <input class='btn' type="submit" value="Pay Now"/>
                <?php } else { ?>

                <p>No payment needed, Thank you for shopping with us!</p>

                <?php } ?>

                <p>You came from: <?php echo $came_from; ?> page.</p>
            
        </div>
    </section>

    <footer></footer>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
</body>
</html> 