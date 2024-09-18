<?php
require_once 'db/db.php';

if (isset($_POST['sku']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['productType'])) {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $productType = $_POST['productType'];

    // Check if SKU already exists
    $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM products WHERE sku = :sku");
    $stmt->execute([':sku' => $sku]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'SKU already exists.'];
        header('Location: add-product.php');
        exit;
    }

    // Save product
    if ($productType == 'DVD') {
        $size = $_POST['size'];
        $product = new DVD($sku, $name, $price, $size);
    } elseif ($productType == 'Furniture') {
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $product = new Furniture($sku, $name, $price, $height, $width, $length);
    } elseif ($productType == 'Book') {
        $weight = $_POST['weight'];
        $product = new Book($sku, $name, $price, $weight);
    }

    $product->save($GLOBALS['pdo']);

    $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Product added successfully.'];
    header('Location: index.php');
    exit;
} else {
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid form data.'];
    header('Location: add-product.php');
    exit;
}