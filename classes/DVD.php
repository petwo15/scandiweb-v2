<?php
class DVD extends Product {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function save(PDO $pdo) {
        $stmt = $pdo->prepare("INSERT INTO products (sku, name, price, size) VALUES (:sku, :name, :price, :size)");
        $stmt->execute([
            ':sku' => $this->sku,
            ':name' => $this->name,
            ':price' => $this->price,
            ':size' => $this->size,
        ]);
    }

    public function getSpecialAttributes() {
        return "Size: " . $this->size . " MB";
    }
}