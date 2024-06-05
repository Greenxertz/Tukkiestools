<?php 

session_start();

if(isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
;
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
<body>
    <header></header>


    <section>
        <div>            
            <h2>Payment</h2>
            <hr>
        </div>
        <div>
        
        <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0) {?>

            <p>Total amount due: R<?php echo $_SESSION['total'] ?></p>
            <input class='btn' type="submit" value="Pay Now"/>
         
        <?php } else if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid" ){ ?>

            <p>Total amount due: R<?php echo $_POST['order_total_price']; ?></p>
            <input class='btn' type="submit" value="Pay Now"/>
        <?php } else { ?>

            <p>All payments are done!</p>

        <?php } ?>


        
       

        </div>
    </section>

    <footer></footer>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
</body>
</html>