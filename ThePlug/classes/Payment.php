<?php

class Payment
{
    private $pdo;
    private $userId;
    private $email;
    private $fullName;
    private $address;
    private $contact;
    private $paymentMethod;
    private $cartItems;
    private $total = 0;
    private $discountCode = '';
    private $discountType = '';
    private $discountValue = 0;
    private $discountAmount = 0;
    private $finalTotal = 0;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function setUser($userId, $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    public function setDeliveryInfo($fullName, $address, $contact)
    {
        $this->fullName = $fullName;
        $this->address = $address;
        $this->contact = $contact;
    }

    public function setPaymentMethod($method)
    {
        $this->paymentMethod = $method;
    }

    public function setCartItems($items)
    {
        $this->cartItems = $items;
    }

    public function setDiscount($code, $type, $value)
    {
        $this->discountCode = $code;
        $this->discountType = $type;
        $this->discountValue = $value;
    }

    public function calculateTotals()
    {
        foreach ($this->cartItems as $item) {
            $stmt = $this->pdo->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->execute([$item['product_id']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $this->total += $product['price'] * $item['quantity'];
            }
        }

        if ($this->discountType === 'percent') {
            $this->discountAmount = ($this->total * $this->discountValue) / 100;
        } elseif ($this->discountType === 'fixed') {
            $this->discountAmount = $this->discountValue;
        }

        $this->finalTotal = max(0, $this->total - $this->discountAmount);
    }

    // process payment here
    public function processOrder()
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders 
            (user_id, user_email, full_name, address, contact, payment_method, discount_code, total, discount_total, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $this->userId,
            $this->email,
            $this->fullName,
            $this->address,
            $this->contact,
            $this->paymentMethod,
            $this->discountCode,
            $this->total,
            $this->finalTotal,
            'Pending'
        ]);

        $orderId = $this->pdo->lastInsertId();

        foreach ($this->cartItems as $item) {
            $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$item['product_id']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $this->pdo->prepare("INSERT INTO order_items 
                    (order_id, product_id, product_name, price, quantity, color, size, image_url) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)")
                    ->execute([
                        $orderId,
                        $item['product_id'],
                        $product['name'],
                        $product['price'],
                        $item['quantity'],
                        $item['color'],
                        $item['size'],
                        $product['image_url']
                    ]);

                $this->pdo->prepare("UPDATE product_variants 
                    SET quantity = quantity - ? 
                    WHERE product_id = ? AND color = ? AND size = ?")
                    ->execute([
                        $item['quantity'],
                        $item['product_id'],
                        $item['color'],
                        $item['size']
                    ]);
            }
        }

        unset($_SESSION['cart'], $_SESSION['discount_code'], $_SESSION['discount_type'], $_SESSION['discount_amount_value']);
        return $orderId;
    }

    public function getFinalTotal()
    {
        return $this->finalTotal;
    }

    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    public function getRawTotal()
    {
        return $this->total;
    }
}
