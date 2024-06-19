<?php 

session_start();

if( !empty($_SESSION['cart'])) {

    //let user in 
    if($_SESSION['logged_in']=='true'){

    } else {
        header('location: ../login.php?message=Please Login/Signup to continue');
    } 
    
    
    // send user back to previous page
} else {

    header('location: shop.php');
}

?>


<?php include('header.php'); ?>

    <section >
        <div class="user-container">
            <h2>Check Out</h2>
            <hr>
        </div>

        <div id="checkout-form">
            <form method="POST" action="server/place_order.php">            
                <div class="form-group">
                    <label>Name:</label>
                    <label style="text-decoration: underline;"><?php echo $_SESSION['user_name']?></label>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <label style="text-decoration: underline;"><?php echo $_SESSION['user_email']?></label>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="tel" class="" name="phone" id="checkout-phone" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <label>City:</label>
                    <input type="text" class="" name="city" id="checkout-city" placeholder="City" required>
                </div>
                <div class="form-group">
                    <label>University:</label>
                    <input type="text" class="" name="address" id="checkout-address" placeholder="University" required>
                </div>
                <p style="color: red;">Total amount: R <?php echo $_SESSION['total']?></p>
                <input type="submit" class="btn" name="place_order" id="checkout-btn" value="Place Order"/>

            </form>
        </div>
    </section>

<?php include('footer.php'); ?>