<?php
require_once '../../ThePlug/classes/Payment.php';

$payment = new Payment(7001, 5001, "Card", 270.00);

if ($payment->getPaymentID() === 7001) {
    echo "✅ Test Passed: Payment ID is correct.<br>";
} else {
    echo "❌ Test Failed: Payment ID is incorrect.<br>";
}

if ($payment->getOrderID() === 5001) {
    echo "✅ Test Passed: Order ID linked to Payment is correct.<br>";
} else {
    echo "❌ Test Failed: Order ID linked to Payment is incorrect.<br>";
}

if ($payment->getPaymentMethod() === "Card") {
    echo "✅ Test Passed: Payment Method is correct.<br>";
} else {
    echo "❌ Test Failed: Payment Method is incorrect.<br>";
}
if ($payment->getAmountPaid() === 270.00) {
    echo "✅ Test Passed: Payment Amount is correct.<br>";
} else {
    echo "❌ Test Failed: Payment Amount is incorrect.<br>";
}

if ($payment->processPayment() === true && $payment->getStatus() === "Paid") {
    echo "✅ Test Passed: Payment processed successfully.<br>";
} else {
    echo "❌ Test Failed: Payment processing failed.<br>";
}

if ($payment->refund() === true && $payment->getStatus() === "Refunded") {
    echo "✅ Test Passed: Payment refunded successfully.<br>";
} else {
    echo "❌ Test Failed: Payment refunding failed.<br>";
}
?>
