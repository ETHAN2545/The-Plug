<?php

class Order
{
    private $pdo;

    private $orderId;
    private $userId;
    private $userEmail;
    private $fullName;
    private $address;
    private $contact;
    private $paymentMethod;
    private $discountCode;
    private $total;
    private $discountTotal;
    private $status;
    private $createdAt;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // setters
    public function setOrderId($orderId) { $this->orderId = $orderId; }
    public function setUserId($userId) { $this->userId = $userId; }
    public function setUserEmail($email) { $this->userEmail = $email; }
    public function setFullName($name) { $this->fullName = $name; }
    public function setAddress($address) { $this->address = $address; }
    public function setContact($contact) { $this->contact = $contact; }
    public function setPaymentMethod($method) { $this->paymentMethod = $method; }
    public function setDiscountCode($code) { $this->discountCode = $code; }
    public function setTotal($amount) { $this->total = $amount; }
    public function setDiscountTotal($amount) { $this->discountTotal = $amount; }
    public function setStatus($status) { $this->status = $status; }
    public function setCreatedAt($timestamp) { $this->createdAt = $timestamp; }

    // getters
    public function getOrderId() { return $this->orderId; }
    public function getUserId() { return $this->userId; }
    public function getUserEmail() { return $this->userEmail; }
    public function getFullName() { return $this->fullName; }
    public function getAddress() { return $this->address; }
    public function getContact() { return $this->contact; }
    public function getPaymentMethod() { return $this->paymentMethod; }
    public function getDiscountCode() { return $this->discountCode; }
    public function getTotal() { return $this->total; }
    public function getDiscountTotal() { return $this->discountTotal; }
    public function getStatus() { return $this->status; }
    public function getCreatedAt() { return $this->createdAt; }

    // Get all orders for a specific user
    public function getOrdersByUser($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all orders 
    public function getAllOrders()
    {
        $stmt = $this->pdo->query("SELECT * FROM orders ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all items for one order
    public function getOrderItems($orderId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update order status
    public function updateStatus($orderId, $newStatus)
    {
        $stmt = $this->pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        return $stmt->execute([$newStatus, $orderId]);
    }
}
