<?php

class Product {
    private int $id;
    private string $name;
    private float $price;
    private string $description;
    private string $imageUrl;
    private string $category;
    private string $color;
    private string $size;

    public function __construct(
        int $id, string $name, float $price, string $description,
        string $imageUrl = '', string $category = '', string $color = '', string $size = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->category = $category;
        $this->color = $color;
        $this->size = $size;
    }
    
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getImageUrl(): string {
        return $this->imageUrl;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function getSize(): string {
        return $this->size;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setImageUrl(string $url): void {
        $this->imageUrl = $url;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }

    public function setColor(string $color): void {
        $this->color = $color;
    }

    public function setSize(string $size): void {
        $this->size = $size;
    }
    public function getSummary(): string {
        return "{$this->name} - €{$this->price}";
    }
}
