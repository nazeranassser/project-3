<?php
namespace App\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Review;
use App\Models\OrderProduct;
class ProductsController
{
    private $productModel;
    private $orderProductModel;
    public $uploadDir = 'images/products/';
    public $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->testimonialModel = new Testimonial();
        $this->orderProductModel = new OrderProduct();
        $this->reviewModel = new Review();
    }

    public function index() {
        $products = $this->productModel->showRow();
        $categories = $this->categoryModel->get();
        require 'views/admin/product/dash-products.php';
    }

    public function filter() {
        $categoryFilter = $_GET['id'] ?? null;
        // echo "Product ID: " . $categoryFilter;
        // die();
        if($categoryFilter!='all'){
            $products = $this->productModel->getProductsByCategoryId($categoryFilter);
            $categories = $this->categoryModel->get();
            require 'views/admin/product/dash-products.php';
        }else{
            $products = $this->productModel->showRow();
            $categories = $this->categoryModel->get();
            header('location:/products');
        }
       
    }

    
    public function edit($id) {
        if(isset($_SESSION['admin_id'])){
            $product=$this->productModel->getProductById($id);
            $categories = $this->categoryModel->get();
            require 'views/admin/product/dash-product-edit.php';
        }
        else{
            header('location:/404');
        }
    }

    public function add() {
        if(isset($_SESSION['admin_id'])){
            $categories = $this->categoryModel->get();
        require 'views/admin/product/dash-product-add.php';}
        else{
            header('location:/404');}
    }

    public function create() {
        if(isset($_SESSION['admin_id'])){
        $products = $this->productModel->addNewProduct($_POST);
        require 'views/admin/product/dash-product-add.php';}
        else{
            header('location:/404');}
    }

    public function update() {
        // var_dump($_POST);
        // var_dump($_POST);
        // die();
        $id = $_POST['product_edit'];
        if (isset($_FILES['image']) && in_array($_FILES['image']['type'], $this->allowedTypes)) {

            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetFile = $this->uploadDir . $fileName;
      
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
              $product_image = 'images/products/' . $fileName;
            } else {
              echo "حدث خطأ أثناء تحميل الصورة.";
            }
          } else {
            $product_image = $_POST['image'];
          }
          $data = [
            'product_name' => $_POST['product_name'],
            'product_description' => $_POST['product_description'],
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity'],
            'product_discount' => $_POST['product_discount'],
            'category_id' => $_POST['category_id'],
            'product_image' => $product_image, // Hash the password
        ];
        if(isset($_SESSION['admin_id'])){
        $products = $this->productModel->updateProduct($id, $data);
        header('location:/products');}
        else{
            header('location:/404');}
    }

    public function addProduct() {
    
        if(isset($_SESSION['admin_id'])){
            // var_dump($_POST);
            
        $products = $this->productModel->addNewProduct($data);
        header('location:/products');
        // else{
        //     header('location:/404');
        }
    }

    public function showHomePage()
    {
        $products = $this->productModel->getLatestProducts(); // Get the latest products
        $allProducts = $this->productModel->getAllProducts(); // Get all products
        $topSellers = $this->productModel->getTopSellers(); // Get the top sellers
        $ourCake = $this->productModel->getProductsByCategory('Cakes'); //get the cakes category
        $sugarFree = $this->productModel->getProductsByCategory('sugar free'); //get the sugar free
        $glutenFree = $this->productModel->getProductsByCategory('gluten free'); //get the gluten free
        $specialOccasions = $this->productModel->getProductsByCategory('special occasions'); //get the special occasions
        $dealOfTheDay = $this->productModel->getDiscountedProducts(); //get the discounted products
        $testimonials = $this->testimonialModel->getAll();
        // Load the view and pass the products data
        require 'views/pages/index-view.php';
    }

    public function showProducts() {
        // Get filters from GET request
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? '';
        $sort = $_GET['sort'] ?? '';

        // Fetch categories for the filter dropdown
        $categories = $this->productModel->getCategories();
        $products = $this->productModel->getFilteredProducts($search, $category, $sort);
        // Load view with products and categories data
        include 'views/pages/products-view.php';
      }

      public function viewProduct($productID) {
        // var_dump($_SESSION);
        // die();
        if ($productID) {
            $product = $this->productModel->getProductById($productID);
            $reviews = $this->reviewModel->getAllReviews($productID);
            if(isset($_SESSION['usersId'])){
                $id = $_SESSION['usersId'];
                // var_dump($id );
                // die();
                $check = $this->orderProductModel->checkPurchase($_SESSION['usersId'], $productID);
            }else{
                $check = false;
            }

            if ($product) {
                include 'views/pages/product-view.php';
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Invalid product ID.";
        }
    }

    // public function delete($id){
       
    //     $data = [
    //         'deleted' => '1',
    //     ];
    //     $this->productModel->update($id,$data);
    //     header('location:/products');
    // }
    public function delete($id){
       
        $this->productModel->deleteProduct($id);
        header('location:/products');
    }
}