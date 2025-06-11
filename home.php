<?php
require_once 'functions.php';
checkLogin();
initCart();

// Handle add to cart
if (isset($_GET['add'])) {
    addToCart((int)$_GET['add']);
    header("Location: home.php");
    exit();
}

$products = getProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products - Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>E-COMMERECE Shopping</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="cart.php">Cart (<?= count($_SESSION['cart']) ?>)</a>
            <a href="index.php?logout">Logout</a>
        </nav>
    </header>

    <div class="products-container">
        <h2> Products</h2>
        <div class="products">
            <?php foreach ($products as $id => $product): ?>
            <div class="product">
                <div class="product-image">📱</div>
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p>Rs. <?= number_format($product['price']) ?></p>
                <a href="home.php?add=<?= $id ?>" class="btn">Add to Cart</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>