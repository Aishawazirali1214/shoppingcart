<?php
require_once 'functions.php';
checkLogin();
initCart();

// Handle remove from cart
if (isset($_GET['remove'])) {
    removeFromCart((int)$_GET['remove']);
    header("Location: cart.php");
    exit();
}

$total = calculateTotal();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart - Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Your Shopping Cart</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="cart.php">Cart (<?= count($_SESSION['cart']) ?>)</a>
            <a href="index.php?logout">Logout</a>
        </nav>
    </header>

    <div class="cart-container">
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty.</p>
            <a href="home.php" class="btn">Continue Shopping</a>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>Rs. <?= number_format($item['price']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>Rs. <?= number_format($item['price'] * $item['quantity']) ?></td>
                        <td><a href="cart.php?remove=<?= $id ?>" class="btn-remove">Remove</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>Rs. <?= number_format($total) ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="cart-actions">
                <a href="home.php" class="btn">Continue Shopping</a>
                <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>