<?php
namespace App\Controllers;
use App\Models\Review;
use App\Models\OrderProduct;
use App\Models\Product;

class ReviewsController
{

    private $reviewModel;
    private $orderProductModel;
    private $productModel;
    public function __construct()
    {
        $this->reviewModel = new Review();
        $this->orderProductModel = new OrderProduct();
        $this->productModel = new Product();
    }

    public function submitReview() {
        var_dump($_POST);
        die();
        session_start();
        if (!isset($_SESSION['userId'])) {
            $_SESSION['message'] = [
                'type' => 'warning',
                'text' => 'You need to log in before reviewing.',
                'redirect' => '/login.php'
            ];
            header("Location: /product/" . $_POST['product_id']);
            exit();
        }

        $userId = $_SESSION['userId'];
        $productId = $_POST['product_id'];

        // Check if the user purchased the product
        if (!$this->orderProductModel->checkPurchase($userId, $productId)) {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'You need to buy the product to review it.'
            ];
            header("Location: /product/" . $productId);
            exit();
        }

        // Proceed with inserting the review
        $reviewText = htmlspecialchars($_POST['review_text']);
        $rating = (float)$_POST['rating'];  // Make sure to treat rating as a float
        $reviewImage = $_FILES['review_image'];

        $uploadPath = '/public/images/reviews/';
        $uploadedImageName = '';

        if ($reviewImage['size'] > 0) {
            $uploadedImageName = time() . '_' . basename($reviewImage['name']);
            move_uploaded_file($reviewImage['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $uploadPath . $uploadedImageName);
        }

        $isInserted = $this->reviewModel->addReview($userId, $productId, $reviewText, $rating, $uploadedImageName);
        
        if ($isInserted) {
            // Update the total review rating and count in the same controller method
            $this->updateTotalReview($productId);
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Your review has been submitted.'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'There was an issue submitting your review. Please try again.'
            ];
        }

        header("Location: /product/" . $productId);
        exit();
    }

    private function updateTotalReview($productId) {
        
        // Calculate the new average review rating
        $averageRating = $this->reviewModel->calculateAverageRating($productId);

        // Update the product's total review with the new average rating
        if ($averageRating !== null) {
            $this->reviewModel->updateProductReview($productId, $averageRating);
        }
    }
   
    

}