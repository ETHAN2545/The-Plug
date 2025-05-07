<?php

class Product
{
    private $pdo;

    private $id;
    private $name;
    private $price;
    private $description;
    private $imageUrl;
    private $category;
    private $color;
    private $size;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Getters 
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getColor() {
        return $this->color;
    }

    public function getSize() {
        return $this->size;
    }

    // Setters 
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    // CRUD Methods 

    public function createProduct($name, $price, $description, $imageUrl, $category)
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, price, description, image_url, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $price, $description, $imageUrl, $category]);
        return $this->pdo->lastInsertId();
    }

    public function updateProduct($id, $name, $price, $description, $imageUrl, $category)
    {
        $stmt = $this->pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, image_url = ?, category = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $description, $imageUrl, $category, $id]);
    }

    public function deleteProduct($id)
    {
        $this->pdo->prepare("DELETE FROM product_variants WHERE product_id = ?")->execute([$id]);
        return $this->pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
    }

    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Variants 

    public function addVariant($productId, $color, $size, $quantity)
    {
        $stmt = $this->pdo->prepare("INSERT INTO product_variants (product_id, color, size, quantity) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$productId, $color, $size, $quantity]);
    }

    public function getVariants($productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM product_variants WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Public filter for shop page 

    public static function filterProducts($pdo, $category, $color, $size)
    {
        $stmt = $pdo->prepare("
            SELECT DISTINCT p.* 
            FROM products p
            JOIN product_variants v ON p.id = v.product_id
            WHERE (:category = '' OR p.category = :category)
              AND (:color = '' OR v.color = :color)
              AND (:size = '' OR v.size = :size)
        ");
        $stmt->execute([
            'category' => $category,
            'color' => $color,
            'size' => $size
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
