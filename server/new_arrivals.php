<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products ORDER BY products_date_added DESC LIMIT 4");

$stmt -> execute();

$featured_products = $stmt -> get_result();