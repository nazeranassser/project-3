<?php
require_once 'config.php';
class Cart {
    private $cartItems = [];

    // Load the cart from cookies
    public function loadCart() {
        if (isset($_COOKIE['cart'])) {
            $this->cartItems = json_decode($_COOKIE['cart'], true);
        }
    }

    // Save the cart to cookies
    public function saveCart() {
        setcookie('cart', json_encode($this->cartItems), time() + (86400 * 30), "/"); // 30 days
    }

    // Add item to the cart
    public function addItem($productId, $productName, $productPrice, $quantity) {
        $existingItemIndex = $this->findItemIndex($productId);

        if ($existingItemIndex !== -1) {
            // Update quantity if item already exists
            $this->cartItems[$existingItemIndex]['quantity'] += $quantity;
        } else {
            // Add new item to the cart
            $this->cartItems[] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => $quantity
            ];
        }

        $this->saveCart(); // Save changes to cookies
    }

    // Remove item from the cart
    public function removeItem($productId) {
        $existingItemIndex = $this->findItemIndex($productId);

        if ($existingItemIndex !== -1) {
            unset($this->cartItems[$existingItemIndex]);
            $this->cartItems = array_values($this->cartItems); // Reindex array
            $this->saveCart(); // Save changes to cookies
        }
    }

    // Get all cart items
    public function getItems() {
        return $this->cartItems;
    }

    // Find item index in the cart
    private function findItemIndex($productId) {
        foreach ($this->cartItems as $index => $item) {
            if ($item['id'] === $productId) {
                return $index;
            }
        }
        return -1; // Item not found
    }

    // Clear the cart
    public function clearCart() {
        $this->cartItems = [];
        $this->saveCart(); // Save changes to cookies
    }
}
