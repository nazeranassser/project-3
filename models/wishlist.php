<?php
class Wishlist {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserWishlist($userId) {
        $this->db->query('SELECT products.product_id, products.product_name, products.product_price, products.product_image 
                          FROM wishlist 
                          JOIN products ON wishlist.product_id = products.product_id 
                          WHERE wishlist.user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function addToWishlist($userId, $productId) {
        $this->db->query('INSERT INTO wishlist (user_id, product_id, added_date) VALUES (:user_id, :product_id, NOW())');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        return $this->db->execute();
    }

    public function removeFromWishlist($userId, $productId) {
        $this->db->query('DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        return $this->db->execute();
    }
}
