<?php 

session_start();

include('connection.php');

if(!isset($_SESSION['logged_in'])) {

    header('location: ../login.php?message=Please Login/Signup to continue');
    
} else {

    // check if the checkout board was completed 
    if (isset($_POST['place_order'])) {

        // Ensure user_id is set in the session
        if (!isset($_SESSION['user_id'])) {
            die("User ID not set in session.");
        }

        //get user details and store it 
        $name = $_SESSION['user_name'];
        $email = $_SESSION['user_email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = 'not paid';
        $user_id = $_SESSION['user_id'];
        $order_date= date('Y-m-d H:i:s');

        $stmt =  $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                        VALUES (?,?,?,?,?,?,?); ");
        $stmt -> bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

        $stmt_status = $stmt -> execute();

        if(!$stmt_status) {
            header('location: login.php');
            exit;
        } else {

            $order_id = $stmt ->insert_id;

            //order details (from session) store order details
            foreach($_SESSION['cart']as $key => $value) {

                $product = $_SESSION['cart'][$key]; 
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $product_image = $product['product_image'];
                $product_category = $product['product_category'];
                $product_price = $product['product_price'];
                $product_quantity = $product['product_quantity'];

                $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_category, product_price, product_quantity, user_id, order_date) 
                            VALUES (?,?,?,?,?,?,?,?,?);"); 

                $stmt1->bind_param('iisssiiis', $order_id, $product_id, $product_name, $product_image, $product_category, $product_price, $product_quantity, $user_id,  $order_date);
            
                $stmt1->execute();
            }
             // clear cart --> delay till payment done
            unset($_SESSION['cart']);
            header('location: ../payment.php?order_status=order placed successfully'); 
        }
       
    }
}
