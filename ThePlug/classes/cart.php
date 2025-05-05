<?php

class Cart
{
    private $items = [];

    public function addToCart(Product $product, string $color, string $size): void
    {
        $key = $this->generateKey($product->getId(), $color, $size);

        if (isset($this->items[$key])) {
            $this->items[$key]['quantity'] += 1;
        } else {
            $this->items[$key] = [
                'product' => $product,
                'color' => $color,
                'size' => $size,
                'quantity' => 1
            ];
        }
    }

    public function removeFromCart(Product $product, string $color, string $size): void
    {
        $key = $this->generateKey($product->getId(), $color, $size);
        unset($this->items[$key]);
    }

    public function viewCart(): array
    {
        return $this->items;
    }

    public function calculateTotal(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    private function generateKey(int $productId, string $color, string $size): string
    {
        return $productId . '-' . strtolower($color) . '-' . $size;
    }
}
