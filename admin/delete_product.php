<?php
session_start(); 




include('admin_header.php'); 

if(!isset($_SESSION['admin_logged_in'])) { 
    header('location: admin_login.php');
    exit;
}

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $stmt ->bind_param('i',$product_id);
    
    if($stmt ->execute()) {
        header('location: products.php?delete_message=Delete was successful');
    }else {
        header('location: products.php?delete_message=Delete was unsuccessful');  
    }

}
?>