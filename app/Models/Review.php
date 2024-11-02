<?php
namespace App\Models;
use PDO; // Use the global PDO class
use PDOException;

use App\Models\Model;

class Review extends Model
{

    public $review_id;
    public $review_rating;
    public $review_text;
    public $product_id;
    public $customer_id;

    public function __construct()
    {
        parent::__construct('reviews');
    }

    public function getAllReviews($productID)
    {
        $query = "SELECT r.*, c.customer_name 
        FROM reviews r 
        JOIN customers c ON r.customer_id = c.customer_id
        where r.product_id = $productID
        ";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function addReview($customerId, $productId, $reviewText, $rating, $reviewImage) {
        $stmt = $this->db->prepare("INSERT INTO reviews (customer_id, product_id, review_text, review_rating, review_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param($customerId, $productId, $reviewText, $rating, $reviewImage);
        return $stmt->execute(); // Return true or false based on execution
    }

    public function calculateAverageRating($productId) {
        $stmt = $this->db->prepare("SELECT AVG(review_rating) AS average_rating FROM reviews WHERE product_id = ?");
        $stmt->bind_param( $productId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result['average_rating']; // Returns the average rating, or null if no reviews
    }

    public function updateProductReview($productId, $newAverageRating) {
        // Update the total_review column with the new average rating
        $updateStmt = $this->db->prepare("UPDATE products SET total_review = ? WHERE product_id = ?");
        $updateStmt->bind_param( $newAverageRating, $productId);
        $updateStmt->execute();
    }

    

}

