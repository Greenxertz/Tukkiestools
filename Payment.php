<?php 

session_start();

// if( !empty($_SESSION['cart']) && isset($_POST['checkout'])) {

//     //let user in 

    
//     // send user back to previous page
// } else {

//     header('location: shop.php');
// }



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
<body>
    <header></header>


    <section>
        <div>            
            <h2>Payment</h2>
            <hr>
        </div>
        <div>
        <p><?php echo $_GET['order_status'];?></p>
        <p>Total amount due: R<?php echo $_SESSION['total']; ?></p>
        <input class='btn' type="submit" name="" id="" value="Pay Now"/>

        </div>
    </section>

    <footer></footer>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
</body>
</html>