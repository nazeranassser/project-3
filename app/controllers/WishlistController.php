<?php
namespace App\Controllers;

use App\Models\Wishlist;

class WishlistController
{
    protected $wishlistModel;

    public function __construct()
    {
        $this->wishlistModel = new Wishlist();
        // Check if user is logged in for all wishlist actions
        $this->checkAuth();
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['usersId'])) {
            header('Location: /login?error=Please login to manage your wishlist');
            exit();
        }
    }

    public function store()
    {
        $productId = $_POST['product_id'] ?? null;
        $userId = $_SESSION['usersId'] ?? null;
        
        if (!$userId) {
            echo json_encode([
                'success' => false,
                'message' => 'Please login to manage your wishlist'
            ]);
            exit();
        }
        
        if (!$productId) {
            echo json_encode([
                'success' => false,
                'message' => 'No product ID provided'
            ]);
            exit();
        }

        // Check if product already exists in wishlist
        $existingProduct = $this->wishlistModel->findByProductIdAndUserId($productId, $userId);
        
        if (!$existingProduct) {
            $result = $this->wishlistModel->create([
                'product_id' => $productId,
                'customer_id' => $userId
            ]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Product added to wishlist'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Product already in wishlist'
            ]);
        }
        exit();
    }

//     public function delete()
// {
//     $productId = $_POST['id'] ?? null; // Changed from 'product_id' to 'id'
//     $userId = $_SESSION['usersId'] ?? null;
    
//     if (!$userId) {
//         echo json_encode([
//             'success' => false,
//             'message' => 'Please login to manage your wishlist'
//         ]);
//         exit();
//     }

//     if (!$productId) {
//         echo json_encode([
//             'success' => false,
//             'message' => 'Product already in wishlist'

//         ]);
//         exit();
//     }

//     $result = $this->wishlistModel->deleteUserProduct($productId, $userId);
//     header('Location: /wishlist');

//     // echo json_encode([
//     //     'success' => $result,
//     //     'message' => $result ? '' : ''
//     // ]);
//     // exit();
// }
public function delete()
{
    $productId = $_POST['product_id'] ?? null; // Changed back to 'product_id'
    $userId = $_SESSION['usersId'] ?? null;
    
    if (!$userId) {
        echo json_encode([
            'success' => false,
            'message' => 'Please login to manage your wishlist'
        ]);
        exit();
    }

    if (!$productId) {
        echo json_encode([
            'success' => false,
            'message' => 'No product ID provided'
        ]);
        exit();
    }

    $result = $this->wishlistModel->deleteUserProduct($productId, $userId);
    
    echo json_encode([
        'success' => $result,
        'message' => $result ? 'Product removed from wishlist' : 'Failed to remove product from wishlist'
    ]);
    exit();
}

    public function show()
    {
        $userId = $_SESSION['usersId'];
        $wishlistItems = $this->wishlistModel->getWishlistWithProductDetails($userId);
        require 'views/pages/wishlist.php';
    }

    public function check()
    {
        $productId = $_GET['product_id'] ?? null;
        $userId = $_SESSION['usersId'];
        
        if ($productId) {
            $existingProduct = $this->wishlistModel->findByProductIdAndUserId($productId, $userId);
            echo json_encode([
                'success' => true,
                'inWishlist' => !empty($existingProduct)
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid product ID'
            ]);
        }
        exit();
    }
}