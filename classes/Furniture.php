<?php
class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function save(PDO $pdo) {
        $stmt = $pdo->prepare("INSERT INTO products (sku, name, price, height, width, length) VALUES (:sku, :name, :price, :height, :width, :length)");
        $stmt->execute([
            ':sku' => $this->sku,
            ':name' => $this->name,
            ':price' => $this->price,
            ':height' => $this->height,
            ':width' => $this->width,
            ':length' => $this->length,
        ]);
    }

    public function getSpecialAttributes() {
        return "Dimensions: " . $this->height . "x" . $this->width . "x" . $this->length . " cm";
    }
}