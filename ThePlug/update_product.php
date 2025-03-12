<?php
include 'db_connect.php';

$product_id = 1; 
$new_price = 899.99;

$sql = "UPDATE products SET price = '$new_price' WHERE id = $product_id";

if ($conn->query($sql) === TRUE) {
    echo "Product updated successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
