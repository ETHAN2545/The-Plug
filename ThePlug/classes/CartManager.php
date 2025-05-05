<?php
class CartManager
{
    // add an item to the cart or adds to one if it already exists
    public static function addItem($productId, $color, $size, $quantity = 1)
    {
        // if no cart is made then  it starts one
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // makes a unique key using product ID, color, size
        $key = $productId . '-' . $color . '-' . $size;

        // if item already in cart, then just increases quantity
        if (isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
        } else {
            // otherwise, add it as new item if details different
            $_SESSION['cart'][$key] = [
                'product_id' => $productId,
                'color' => $color,
                'size' => $size,
                'quantity' => $quantity
            ];
        }
    }

    // removes a specific item from the cart
    public static function removeItem($key)
    {
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
    }

    // gets the full cart
    public static function getCart()
    {
        return $_SESSION['cart'] ?? [];
    }

    // clears the whole cart
    public static function clearCart()
    {
        unset($_SESSION['cart']);
    }
}
