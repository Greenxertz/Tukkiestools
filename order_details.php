<?php 

// keywords: not paid, delivered, shipped

session_start();
include('server/connection.php');
 
if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $_SESSION['came_from'] = 'account';

    $stmt = $conn-> prepare("SELECT * FROM order_items WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt-> execute();

    $order_details = $stmt-> get_result();
    $order_total_price= calculateTotalOrderPrice($order_details);


} else {
    header('location: account.php');
}

function calculateTotalOrderPrice($order_details){

    $total=0;

    foreach( $order_details as $row) {
       $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price *  $product_quantity);
    }

    return $total;
}

?>

<?php include('header.php'); ?>

    <section id="orders-details">
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php foreach($order_details as $row) {?>
                <tr>
                    <td>
                        <img src="assets/images/Shop-images/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                        <div>
                            <p><?php echo $row['product_name']; ?></p>
                        </div>

                    </td>

                    <td>                       
                        <p>R <?php echo $row['product_price']; ?></p>
                    </td>

                    <td>                       
                        <p><?php echo $row['product_quantity']; ?></p>
                    </td>
                </tr>
            <?php }?>
        </table>
        
        <?php if($order_status == "not paid") { ?>
            <div class="btn-container">
                <form style="float: right" method="POST" action="payment.php">
                    <input type="hidden" name="order_total_price" value="<?php echo  $order_total_price;?>">
                    <input type="hidden" name="order_status" value="<?php echo  $order_status;?>">
                    <p>Total amount due: R <?php echo  $order_total_price;?></p>
                    <input type="submit" name="order_pay_btn" class="btn" id="pay_btn" value="Pay Now">
                </form>
            </div>
        <?php }?>
    </section>

    

 <?php include('footer.php'); ?>