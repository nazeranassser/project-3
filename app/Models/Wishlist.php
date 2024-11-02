<?php 
namespace App\Models;
use PDO;
use PDOException;

class Wishlist extends Model
{
    public function __construct()
    {
        parent::__construct('wishlists');
    }

    public function getWishlistWithProductDetails($userId)
    {
        $stmt = $this->db->prepare("
            SELECT wishlists.*, 
                   products.product_name AS title, 
                   products.product_description AS description, 
                   products.product_price AS price, 
                   products.product_image, 
                   products.category_id, 
                   products.product_quantity, 
                   products.total_review, 
                   products.product_discount, 
                   products.created_at, 
                   products.updated_at 
            FROM {$this->table} 
            JOIN products ON wishlists.product_id = products.product_id
            WHERE wishlists.customer_id = :customer_id
        ");
        $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUserProduct($productId, $userId)
    {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM wishlists 
                WHERE product_id = :product_id 
                AND customer_id = :customer_id
            ");
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error deleting from wishlist: " . $e->getMessage());
            return false;
        }
    }

    public function findByProductIdAndUserId($productId, $userId)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE product_id = :product_id 
            AND customer_id = :customer_id
        ");
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO {$this->table} (product_id, customer_id) 
                VALUES (:product_id, :customer_id)
            ");
            $stmt->bindParam(':product_id', $data['product_id'], PDO::PARAM_INT);
            $stmt->bindParam(':customer_id', $data['customer_id'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error creating wishlist entry: " . $e->getMessage());
            return false;
        }
    }
} 

