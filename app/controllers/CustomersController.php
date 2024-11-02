<?php
namespace App\Controllers;
use App\Models\Customer;



class CustomersController {
    public $uploadDir = 'images/products/';
    public $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
    private $customerModel;

    public function __construct() {
        $this->customerModel = new Customer();
    }

    public function loginPage(){
        require 'login.php'; // Adjust the path accordingly
    }

    public function signupPage(){
        require 'signup.php';
    }

    public function index() {
        $customers = $this->customerModel->showRow();
        require 'views/admin/customers/dash-customers.php';
    }

    public function get() {
        if ($customers = $this->customerModel->showRow()) {
            require 'views/admin/customers/dash-customers.php'; // Adjust path as needed
        } else {
            echo 'No admins found.';
        }
    }

    public function add() {
        require 'views/admin/admins/dash-admin-add.php'; // Adjust the path accordingly
    }

    public function registerCustomer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the posted data
            $data = [
                'admin_name' => $_POST['name'],
                'admin_email' => $_POST['email'],
                'admin_password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hash the password
            ];

            // Call the model to add the admin
            if ($this->customerModel->addNew($data)) {
                // Redirect or show a success message
                header('location: /');
            } else {
                echo "Failed to add admin.";
            }
        } else {
            // If it's not a POST request, redirect or show an error
            echo "Invalid request.";
        }
    }
    

    public function register(){
        // Process form
        
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       
        // Init data
        $data = [
            'customer_email' => trim($_POST['customerEmail']),
            'customer_name' => trim($_POST['customerName']),
            'customer_password' => trim($_POST['customerPassword']),
            'customer_address1' => trim($_POST['customerAddress']),
            'customer_address2' => trim($_POST['customerAddress2']),
            'customer_phone' => trim($_POST['customerPhone']),
            'customer_image' => trim('images/products/671fb3380fb81_user.png'),
        ];
        // Validate inputs
        if(empty($data['customer_email']) || empty($data['customer_name']) || 
        empty($data['customer_password']) || empty($_POST['pwdRepeat'])){
            flash("register", "Please fill out all inputs");
            redirect("../signup.php");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['customer_name'])){
            flash("register", "Invalid username");
            redirect("../signup.php");
        }

        if(!filter_var($data['customer_email'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Invalid email");
            redirect("../signup.php");
        }

        // Validate password
          if(strlen($data['customer_password']) < 8 || 
          !preg_match("/[A-Z]/", $data['customer_password']) || 
          !preg_match("/[a-z]/", $data['customer_password']) || 
          !preg_match("/[0-9]/", $data['customer_password']) || 
          !preg_match("/[\W_]/", $data['customer_password'])) {
          flash("register", "Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character");
          redirect("../signup.php");
           } else if($data['customer_password'] != $_POST['pwdRepeat']){
          flash("register", "Passwords don't match");
           redirect("../signup.php");
           }


          // Validate phone number
        if (!preg_match("/^07\d{8}$/", $data['customer_phone']) || !ctype_digit($data['customer_phone'])) {
           flash("register", "Phone number must be exactly 10 digits and start with 07");
           redirect("../signup.php");
        }


        // User with the same email or username already exists
        if($this->customerModel->findUserByEmailOrUsername($data['customer_email'])){
            flash("register", "Username or email already taken");
            redirect("../signup.php");
        }

        // Passed all validation checks.
        // Now going to hash password
        $data['customer_password'] = password_hash($data['customer_password'], PASSWORD_DEFAULT);

      // Register User
          if($this->customerModel->register($data)){
          flash("register", "Yay! Your account is all set 🎉. Get ready to explore the sweetest treats!");
          redirect("/login");       
         header("location: /login");
          } else {
                    die("Something went wrong");
         }
       }

    public function login(){
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
            'customer_email' => trim($_POST['customerNameOrEmail']),
            'customer_password' => trim($_POST['customerPassword'])
        ];

        if(empty($data['customer_email']) || empty($data['customer_password'])){
            flash("login", "Please fill out all inputs");
            header("location: /login");
            exit();
        }

        // Check for user/email
        if($this->customerModel->findUserByEmailOrUsername($data['customer_email'])){
            // User Found
            $loggedInUser = $this->customerModel->login($data['customer_email'], $data['customer_password']);
            if($loggedInUser){
                // Create session
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Password Incorrect");
                header("Location: login");
            }
        } else {
            flash("login", "No user found");
            redirect("../login.php");
        }
    }

    public function createUserSession($user){
        $_SESSION['usersId'] = $user['customer_id'];
        $_SESSION['usersName'] = $user['customer_name'];
        $_SESSION['customerEmail'] = $user['customer_email'];
        $_SESSION['customerImage'] = $user['customer_image'];
        header("Location: / ");
    }

    public function logout(){
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['customerEmail']);
        session_destroy();
        header("Location: /");
    }
    public function getById(){
        //   $id=$_SESSION['sutomer_id'];
           $customer = $this->customerModel->getCustomer($_SESSION['usersId']);
           require "views/profile/profile.main.php";
           
       }
       public function getById1(){
        $customer = $this->customerModel->getCustomer($_SESSION['usersId']);
        $orders = $this->customerModel->getCustomerOrders($_SESSION['usersId']);
              require "views/profile/profile.order.php";
              
          }
          public function editPage(){
            $customer = $this->customerModel->getCustomer($_SESSION['usersId']);
            require "views/profile/profile.edit.php"; // Adjust the path accordingly
        }
    function update() {
        if (isset($_FILES['image']) && in_array($_FILES['image']['type'], $this->allowedTypes)) {
            $fileName = uniqid() . '' . basename($_FILES['image']['name']);
            $targetFile = $this->uploadDir . $fileName;
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $customer_image = 'images/products/' . $fileName;
            } else {
                echo "Error uploading image.";
                
            }
        } else {
            $customer_image = $customer['image'] ?? null;
        }
        
        $data = [
            'customer_name' => $_POST['firstname'],
            'customer_email' => $_POST['email'],
            'customer_phone' => $_POST['phone'],
            'customer_address1' => $_POST['address1'],
            'customer_address2' => $_POST['address2'],
            'customer_image' => $customer_image,
            // 'customer_image' => $_POST['customer_image'],
        ];
        if ($this->customerModel->updateCustomer($_SESSION['usersId'], $data)) {
            // Redirect or show a success message
            header("location:/profile-main");
        } else {
            echo "Failed to add admin.";
        }
    }

    public function viewOrderDetails($order_id) {
        if (!isset($_SESSION['usersId'])) {
            header('Location: /login');
            exit();
            }
        
        
        // إضافة طباعة للتأكد من القيم
        error_log("Fetching order details for order_id: $order_id, customer_id: " . $_SESSION['usersId']);
        
        $order_details = $this->customerModel->getOrderDetails($order_id, $_SESSION['usersId']);
        // dd($order_details);
        // var_dump($_SESSION['usersId']);
        // die();
        if (!$order_details) {
            header('Location: /profile-order');
            exit();
        }
        
        // تجهيز البيانات للعرض
        $order = [
            'order_ID' => $order_details[0]['order_ID'],
            'order_date' => $order_details[0]['order_date'],
            'status' => $order_details[0]['status'],
            'total_amount' => $order_details[0]['total_amount']
        ];
        
        // تمرير المتغيرات للview
        require 'views/profile/profile.orderdetal.php';
    }
    public function about() {
        require 'views/pages/aboutus.php';
    }

    function customerDetails($id){
        echo $id;
    }
    function respass(){
        require 'views/profile/profile.respass.php';
    }
}