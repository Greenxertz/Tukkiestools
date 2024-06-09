<?php
session_start();
$came_from = isset($_SESSION['came_from']) ? $_SESSION['came_from'] : 'unknown';
?>


<?php include('header.php'); ?>

    <section >
        <div class="user-container">            
            <h2>Payment</h2>
            <hr>
        </div>
        <div id="payment-form">
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

<?php include('footer.php'); ?>