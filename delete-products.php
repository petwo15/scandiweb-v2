<?php
require_once 'db/db.php';

if (isset($_POST['sku'])) {
    $sku = $_POST['sku'];

    // Delete product
    $stmt = $GLOBALS['pdo']->prepare("DELETE FROM products WHERE sku = :sku");
    $stmt->execute([':sku' => $sku]);

    $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Product deleted successfully.'];
    header('Location: index.php');
    exit;
} else {
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid form data.'];
    header('Location: index.php');
    exit;
}