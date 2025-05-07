<?php

class Cart
{
    private $productId;
    private $color;
    private $size;
    private $quantity;

    public function __construct($productId = null, $color = '', $size = '', $quantity = 1)
    {
        $this->productId = $productId;
        $this->color = $color;
        $this->size = $size;
        $this->quantity = $quantity;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    // Setters
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function addToCart()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $key = $this->productId . '-' . $this->color . '-' . $this->size;

        if (isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['quantity'] += $this->quantity;
        } else {
            $_SESSION['cart'][$key] = [
                'product_id' => $this->productId,
                'color' => $this->color,
                'size' => $this->size,
                'quantity' => $this->quantity
            ];
        }
    }

    public function removeFromCart($key)
    {
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
    }

    public function getCartSession()
    {
        return $_SESSION['cart'] ?? [];
    }

    public function clearCart()
    {
        unset($_SESSION['cart']);
    }

    public function getCartDetails($pdo, $promoCode = '')
    {
        $items = $this->getCartSession();
        $details = [];
        $total = 0;
    
        foreach ($items as $key => $item) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$item['product_id']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($product) {
                $subtotal = $product['price'] * $item['quantity'];
                $total += $subtotal;
    
                $details[] = [
                    'key' => $key,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'color' => $item['color'],
                    'size' => $item['size'],
                    'subtotal' => $subtotal
                ];
            }
        }
    // discount logic gets from discount table applies the type and calculates final total
        $discountAmount = 0;
    
        if (!empty($promoCode)) {
            $stmt = $pdo->prepare("SELECT * FROM discounts WHERE code = ? AND is_active = 1 LIMIT 1");
            $stmt->execute([$promoCode]);
            $discount = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($discount) {
                if ($discount['type'] === 'percent') {
                    $discountAmount = ($total * $discount['amount']) / 100;
                } elseif ($discount['type'] === 'fixed') {
                    $discountAmount = $discount['amount'];
                }
            }
        }
    
        $finalTotal = max(0, $total - $discountAmount);
    
        return [
            'items' => $details,
            'raw_total' => $total,
            'discount' => $discountAmount,
            'final_total' => $finalTotal
        ];
    }
}    