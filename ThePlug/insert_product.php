<?php
include 'db_connect.php';

$name = "Nike SB Dunk Low Day of the Dead";
$brand = "Nike";
$category = "Sneakers";
$price = 3100.00;
$description = "Nike SB Dunk Low Day of the Dead is a highly sought-after sneaker.";
$image = "images/dayofthedead.png";

$sql = "INSERT INTO products (name, brand, category, price, description, image) VALUES ('$name', '$brand', '$category', '$price', '$description', '$image')";

if ($conn->query($sql) === TRUE) {
    echo "New product added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
