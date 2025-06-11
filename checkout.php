<?php
require_once 'functions.php';
checkLogin();
initCart();

if (empty($_SESSION['cart'])) {
    header("Location: home.php");
    exit();
}

$total = calculateTotal();

// Handle checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = 'ORD-' . uniqid();
    $_SESSION['cart'] = [];
    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Checkout</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="cart.php">Cart (<?= count($_SESSION['cart']) ?>)</a>
            <a href="index.php?logout">Logout</a>
        </nav>
    </header>

    <div class="checkout-container">
        <?php if (isset($success)): ?>
            <div class="success-message">
                <h2>Order Placed Successfully!</h2>
                <p>Your order ID: <?= $order_id ?></p>
                <p>Total: Rs. <?= number_format($total) ?></p>
                <a href="home.php" class="btn">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="order-summary">
                <h2>Order Summary</h2>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <li>
                        <?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?>
                        <span>Rs. <?= number_format($item['price'] * $item['quantity']) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="total">
                    <strong>Total:</strong>
                    <span>Rs. <?= number_format($total) ?></span>
                </div>
            </div>

            <form method="POST" class="checkout-form">
                <h2>Shipping Information</h2>
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <textarea name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="tel" name="phone" required>
                </div>

                <h2>Payment Method</h2>
                <div class="payment-methods">
                    <label><input type="radio" name="payment" value="cod" checked> Cash on Delivery</label>
                </div>

                <button type="submit" class="btn checkout-btn">Place Order</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>