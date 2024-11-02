<?php
require '../../config.php';
require_once '../../models/Order.php';  // Assuming OrderModel is here
require_once '../models/Customers.php';  // Assuming CustomerModel is here

class CartController {
    private $cart = [];

    public function __construct() {
        // Load cart from cookies or initialize it
        $this->cart = $this->getCartFromCookies();
    }

    // Get cart items from cookies
    private function getCartFromCookies() {
        if (isset($_COOKIE['cart'])) {
            return json_decode($_COOKIE['cart'], true) ?: [];
        }
        return [];
    }

    // Save cart items to cookies
    private function saveCartToCookies() {
        setcookie('cart', json_encode($this->cart), time() + (86400 * 30), "/"); // 30 days
    }

    // Add item to cart
    public function addToCart($product) {
        $this->cart[] = $product;
        $this->saveCartToCookies();
    }

    // Remove item from cart
    public function removeFromCart($productId) {
        $this->cart = array_filter($this->cart, function($item) use ($productId) {
            return $item['id'] !== $productId;
        });
        $this->saveCartToCookies();
    }

    // Clear cart
    public function clearCart() {
        $this->cart = [];
        $this->saveCartToCookies();
    }

    // Get cart items
    public function getCartItems() {
        return $this->cart;
    }

    // Get cart total
    public function getCartTotal() {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // Checkout function
    public function checkout($customerData) {
        $orderModel = new OrderModel();
        $orderId = $orderModel->createOrder($this->cart, $customerData);
        $this->clearCart(); // Clear cart after checkout
        return $orderId;
    }
}
