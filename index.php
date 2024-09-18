<?php
require_once 'includes/header.php';

// Include database connection
require_once 'db/db.php';

// Fetch all products
$stmt = $GLOBALS['pdo']->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION['flash_message'])) {
    echo '<div class="alert alert-' . $_SESSION['flash_message']['type'] . '">' . $_SESSION['flash_message']['message'] . '</div>';
    unset($_SESSION['flash_message']);
}

?>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h1>Product List</h1>
        <div>
            <a href="add-product.php" class="btn btn-primary">ADD</a>
            <button id="delete-product-btn" class="btn btn-danger">MASS DELETE</button>
        </div>
    </div>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="product-card">
                    <div class="card-header">Product SKU</div>
                    <div class="card-body">
                        <input type="checkbox" class="delete-checkbox" data-sku="<?= $product['sku'] ?>">
                        <h5><?= $product['name'] ?></h5>
                        <small>SKU: <?= $product['sku'] ?></small>
                        <small>Price: $<?= number_format($product['price'], 2) ?></small>
                        <?php if ($product['type'] == 'DVD'): ?>
                            <small>Size: <?= $product['size'] ?> MB</small>
                        <?php elseif ($product['type'] == 'Furniture'): ?>
                            <small>Dimension: <?= $product['height'] ?>x<?= $product['width'] ?>x<?= $product['length'] ?> CM</small>
                        <?php elseif ($product['type'] == 'Book'): ?>
                            <small>Weight: <?= $product['weight'] ?> KG</small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="assets/js/delete-products.js"></script>

<?php include 'includes/footer.php'; ?>