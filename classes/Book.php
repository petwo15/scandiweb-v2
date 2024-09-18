<?php
class Book extends Product {
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function save(PDO $pdo) {
        $stmt = $pdo->prepare("INSERT INTO products (sku, name, price, weight) VALUES (:sku, :name, :price, :weight)");
        $stmt->execute([
            ':sku' => $this->sku,
            ':name' => $this->name,
            ':price' => $this->price,
            ':weight' => $this->weight,
        ]);
    }

    public function getSpecialAttributes() {
        return "Weight: " . $this->weight . " kg";
    }
}