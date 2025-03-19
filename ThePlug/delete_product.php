<?php
include 'db_connect.php';

$product_id = 2; 

$sql = "DELETE FROM products WHERE id = $product_id";

if ($conn->query($sql) === TRUE) {
    echo "Product deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
