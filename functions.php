<?php
session_start();

// Sample products database
function getProducts() {
    return [
        1 => ['name' => 'iPhone', 'price' => 2999, 'image' => 'headphones.jpg'],
        2 => ['name' => 'Vivo', 'price' => 4999, 'image' => 'phone1.jpg'],
        3 => ['name' => 'Techno', 'price' => 1999, 'image' => 'speaker.jpg'],
        4 => ['name' => 'Oppo', 'price' => 1499, 'image' => 'powerbank.jpg'],
        5 => ['name' => 'Nokia', 'price' => 2999, 'image' => 'headphones.jpg'],
        6 => ['name' => 'Samsung', 'price' => 4999, 'image' => 'watch.jpg'],
        7 => ['name' => 'Redmi', 'price' => 1999, 'image' => 'speaker.jpg'],
        8 => ['name' => 'iPhone', 'price' => 1499, 'image' => 'powerbank.jpg']
    ];
}

// Initialize cart
function initCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

// Add to cart
function addToCart($productId) {
    $products = getProducts();
    if (isset($products[$productId])) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = [
                'name' => $products[$productId]['name'],
                'price' => $products[$productId]['price'],
                'image' => $products[$productId]['image'],
                'quantity' => 1
            ];
        }
        return true;
    }
    return false;
}

// Remove from cart
function removeFromCart($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        return true;
    }
    return false;
}

// Calculate total
function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user']);
}

// Redirect if not logged in
function checkLogin() {
    if (!isLoggedIn()) {
        header("Location: index.php");
        exit();
    }
}
?>