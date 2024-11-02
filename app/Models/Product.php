<?php
namespace App\Models;
use App\Models\Model;
use PDO; // Use the global PDO class
use PDOException;
class Product extends Model
{

  private $conn;
  public $product_id;
  public $product_name;
  public $product_price;
  public $product_image;
  public $product_description;
  public $product_quantity;
  public $category_id;
  public $product_discount;
  public $quantity;


  public $uploadDir = 'images/products/';
  public $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

  public function __construct() {
    parent::__construct('products');
    $this->conn = Database::getInstance()->getConnection(); // Get the database connection

    
   }

  public function getAll(){
    return $this->get();
  }

  function showRow()
  {
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();

    $sql = "SELECT * FROM products;";
    $start = $conn->query($sql);
    if ($start) {
      $row = $start->fetchAll(PDO::FETCH_ASSOC);
      return $row;
    } else {
      echo "0 results";
    }
  }

  public function getFilteredProducts($search, $category, $sort) {
    $query = "SELECT p.*, c.category_name FROM products p 
              JOIN categories c ON p.category_id = c.category_id 
              WHERE 1=1"; // 1=1 is a common way to start a dynamic WHERE clause
    $params = [];

    // Search filter
    if (!empty($search)) {
        $query .= " AND p.product_name LIKE :search";
        $params[':search'] = '%' . $search . '%';
    }

    // Category filter
    if (!empty($category)) {
        $query .= " AND c.category_name = :category";
        $params[':category'] = $category;
    }

    // Sorting
    if ($sort == 'price_asc') {
        $query .= " ORDER BY p.product_price ASC";
    } elseif ($sort == 'price_desc') {
        $query .= " ORDER BY p.product_price DESC";
    } elseif ($sort == 'rating') {
        $query .= " ORDER BY p.total_review DESC";
    }

    // Prepare and execute the query
    $stmt = $this->db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return an array of products
}

/**
 * Fetch all categories from the database.
 */
public function getCategoriesFilter() {
    $query = "SELECT c.category_name, COUNT(p.product_id) AS product_count
              FROM categories c
              LEFT JOIN products p ON c.category_id = p.category_id
              GROUP BY c.category_name";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return an array of categories
}

  function updateProduct($id,$product)
{
  return $this->update($id,$product);

    // $dbInstance = Database::getInstance();
    // $conn = $dbInstance->getConnection();

    // if (isset($_FILES['image']) && in_array($_FILES['image']['type'], $this->allowedTypes)) {
    //     $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
    //     $targetFile = $this->uploadDir . $fileName;

    //     if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    //         $product_image = 'images/products/' . $fileName;
    //     } else {
    //         echo "Error uploading image.";
    //         return; // Stop execution if image upload fails
    //     }
    // } else {
    //     $product_image = $admin['image'] ?? null;
    // }

    // $id = $admin['product_edit'] ?? null;
    // $name = $admin['product_name'] ?? '';
    // $category = $admin['category'] ?? '';
    // $description = $admin['description'] ?? '';
    // $product_price = $admin['price'] ?? 0;
    // $product_quantity = $admin['quantity'] ?? 0;

    // $sql = "UPDATE products 
    //         SET product_name = :name, 
    //             category_id = :category, 
    //             product_description = :description, 
    //             product_price = :price, 
    //             product_quantity = :quantity, 
    //             product_image = :image 
    //         WHERE product_id = :id";

    // $stmt = $this->conn->prepare($sql);

    // $stmt->bindParam(':name', $name);
    // $stmt->bindParam(':category', $category);
    // $stmt->bindParam(':description', $description);
    // $stmt->bindParam(':price', $product_price);
    // $stmt->bindParam(':quantity', $product_quantity);
    // $stmt->bindParam(':image', $product_image);
    // $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // if ($stmt->execute()) {
    //     header("Location: /products");
    //     exit(); // Exit after header redirect
    // } else {
    //     echo "Database update failed.";
    // }
}

  function addNewProduct($admin)
  {
    $this->create($admin);
  }

  public function getLatestProducts($limit = 4)
  {
    // $dbInstance = Database::getInstance();
    // $conn = $dbInstance->getConnection();

    $sql = "
            SELECT p.product_id, p.product_name, p.product_price, p.product_image, p.total_review, c.category_name, c.category_id ,product_discount
            FROM products p
            INNER JOIN categories c ON p.category_id = c.category_id
            ORDER BY p.product_id DESC
            LIMIT :limit
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
      echo "0 results";
    }
  }

  public function getAllProducts()
  {
    $query = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTopSellers($limit = 4)
  {
    $query = "SELECT p.*, c.category_name 
    FROM products p 
    JOIN categories c ON p.category_id = c.category_id 
    JOIN order_Products op ON p.product_id = op.product_id 
    GROUP BY p.product_id 
    ORDER BY COUNT(op.product_id) DESC 
    LIMIT :limit";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getProductsByCategoryId($category)
  {
    $query = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id";
    if($category!=''){
      $query.="  WHERE c.category_id = :category";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':category', $category);
    }else{
      $stmt = $this->conn->prepare($query);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getProductsByCategory($category)
  {
    $query = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE c.category_name = :category";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getDiscountedProducts() {
    $sql = "SELECT product_id, product_name, product_image, product_price, product_discount, total_review ,category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.category_id
            WHERE product_discount IS NOT NULL
            ORDER BY product_discount DESC
            LIMIT 2";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as &$product) {
      $product['discounted_price'] = $product['product_price'] - ($product['product_price'] * $product['product_discount']);
    }

    return $products;
  }

  public function getProductById($productID) {
    $query = "SELECT p.*, c.category_name, AVG(r.review_rating) AS avg_rating, COUNT(r.review_id) AS review_count
              FROM products p
              LEFT JOIN categories c ON p.category_id = c.category_id
              LEFT JOIN reviews r ON p.product_id = r.product_id
              WHERE p.product_id = :productID
              GROUP BY p.product_id";
    
    $stmt = $this->conn->prepare($query);
    $stmt->execute([':productID' => $productID]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function getCategories() {
  try {
      $query = "SELECT c.category_name, COUNT(p.product_id) AS product_count 
                FROM categories c
                LEFT JOIN products p ON c.category_id = p.category_id
                GROUP BY c.category_name";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return null;
  }
}
public function getProducts($search = '', $category = '', $sort = '') {
  $query = "SELECT p.*, c.category_name, AVG(r.review_rating) AS avg_rating, COUNT(r.review_id) AS review_count
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.category_id
            LEFT JOIN reviews r ON p.product_id = r.product_id
            WHERE 1=1";

  $params = [];

  // Add search filter
  if (!empty($search)) {
      $query .= " AND p.product_name LIKE :search";
      $params[':search'] = "%$search%";
  }

  // Add category filter
  if (!empty($category)) {
      $query .= " AND c.category_name = :category";
      $params[':category'] = $category;
  }

  // Sorting
  switch ($sort) {
      case 'price_asc':
          $query .= " ORDER BY p.product_price ASC";
          break;
      case 'price_desc':
          $query .= " ORDER BY p.product_price DESC";
          break;
      case 'rating':
          $query .= " ORDER BY avg_rating DESC";
          break;
      default:
          $query .= " ORDER BY p.created_at DESC";
  }

  $stmt = $this->conn->prepare($query);
  $stmt->execute($params);

  return $stmt;
}
public function updateProductReview($productId) {
  $stmt = $this->db->prepare("SELECT SUM(review_rating) AS totalRating, COUNT(*) AS reviewCount 
                               FROM reviews WHERE product_id = ?");
  $stmt->execute([$productId]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result['reviewCount'] > 0) {
      $averageRating = $result['totalRating'] / $result['reviewCount'];

      $updateStmt = $this->db->prepare("UPDATE products SET total_review = ? WHERE product_ID = ?");
      $updateStmt->execute([round($averageRating, 2), $productId]);
  }
}

public function deleteProduct($id){
  return $this->delete($id);
} 

public function findById($id) {
  {
    try {
        $query = $this->db->prepare("SELECT * FROM products WHERE product_id = :product_id");
        $query->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $query->execute();

        // Fetch product details as an associative array
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle error if needed (logging or error message)
        return false;
    }
}
}

}