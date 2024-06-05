<?php 

// keywords: not paid, delivered, shipped

session_start();
include('server/connection.php');
 
if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];


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
                        <img src="assets/images/Shop-images/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
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

            <form style="float: right" method="POST" action="Payment.php">
                <input type="hidden" name="order_total_price" value="<?php echo  $order_total_price;?> ">
                <input type="hidden" name="order_status" value="<?php echo  $order_status;?> ">
                <input type="submit" name="order_pay_btn" class="btn" value="Pay Noy">
            </form>
        <?php }?>
    </section>

    

    <footer></footer>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
    
</body>

</html> 