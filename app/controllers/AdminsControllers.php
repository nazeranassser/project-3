<?php

// require 'Models/Admin.php';
// // include '../Model/Admins.php';

//     // $controller = new AdminController();
//     // if ($_POST['add_admin_name']) {
//     //    $controller->register($_POST);
//     // }
//     // namespace App\Controllers;
//     // use Model\Admin;

//     class AdminController {
//     private $adminModel;
 
//     public function __construct() {
//        $this->adminModel = new Admin;
//     }


//     public function index(){
//         $this->get();
//     }

//     public function register($admin) {
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         $data = [
//             'admin_name' => $_POST['add_admin_name'],
//             'admin_email' => $_POST['admin_email'],
//             'admin_password' => password_hash($_POST['admin_password'], PASSWORD_DEFAULT),
//             'date' => date("Y/m/d h:m:s"),
//          ];
//           if ($this->adminModel->addNew($data)) {
//                 if($this->adminModel->showRow()){
//                     $admins = $this->adminModel->showRow();
//                     // var_dump($admins);
//                     require '../../dash-admins.php';
//                      // Redirect to success page
//                 }
//           }
//        } else {
//         //   include '../dash-admin-add.php';  // Load view if no POST request
//        }
//     }

//     function get(){
//         if($this->adminModel->showRow()){
//             $admins = $this->adminModel->showRow();
//             // var_dump($admins);
//             require '../../dash-admins.php';
//              // Redirect to success page
//         }
//     }
//  }

// namespace Controller;
namespace App\Controllers;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
require 'app/helpers/session_helper.php';

class AdminsController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new Admin();
        $this->orderModel = new Order();
        $this->categoryModel = new Category();
        $this->customerModel = new Customer();
        $this->orderModel->showOrdersProcessing();
        $this->orderModel->showOrdersDelivered();
        $this->orderModel->showOrdersCancelled();
    }

    public function index() {
        if(isset($_SESSION['admin_id'])){
            // $catee
            $admins = $this->adminModel->getAll();
            $orders = $this->orderModel->showOrders();
            $total = $this->orderModel->totalSales();
            $totalOrders = $this->orderModel->totalOrders();
            $totalCustomers = $this->customerModel->totalCustomers();
            require 'views/admin/dashboard_admin.php';
        }else{
            require 'views/pages/404.php';
        }
        
    }

    public function get() {
        if(isset($_SESSION['is_super']) && $_SESSION['is_super']==1){
            if ($admins = $this->adminModel->getAll()) {
                require 'views/admin/admins/dash-admins.php'; // Adjust path as needed
            } else {
                echo 'No admins found.';
            }
        }else{
            require 'views/pages/404.php';
        }
    }

    public function getById($id){
        $admin = $this->adminModel->findById($id);
        require 'views/admin/admins/dash-admin-edit.php';
    }

    public function delete($id){
        // echo $id;
        // var_dump($_GET);
        // die();
        $data = [
            'is_active' => $_GET['admin_status'],
        ];
        $this->adminModel->update($id,$data);
        header('location:/admins');
    }

    public function add() {
        if(isset($_SESSION['is_super']) && $_SESSION['is_super']==1){
        require 'views/admin/admins/dash-admin-add.php';}
        else{
            require 'views/pages/404.php';
        } // Adjust the path accordingly
    }
    public function edit() {
        if(isset($_SESSION['is_super']) && $_SESSION['is_super']==1){
            require 'views/admin/admins/dash-admin-edit.php';}
            else{
                require 'views/pages/404.php';
            }
         // Adjust the path accordingly
    }
    public function loginPage() {
        require 'views/admin/login.php'; // Adjust the path accordingly
    }

    public function register() {
        if(isset($_SESSION['is_super'])){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get the posted data
                $data = [
                    'admin_name' => $_POST['name'],
                    'admin_email' => $_POST['email'],
                    'admin_password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hash the password
                    'created_at' => date("Y/m/d h:m:s")
                ];
    
                // Call the model to add the admin
                if ($this->adminModel->createAdmin($data)) {
                    // Redirect or show a success message
                    $this->get();
                } else {
                    echo "Failed to add admin.";
                }
            } else {
                // If it's not a POST request, redirect or show an error
                echo "Invalid request.";
            }
        }else{
            redirect("dash");
        }
        
    }

    function update() {
        $id = $_POST['edit'];
        $data = [
            'admin_name' => $_POST['admin_name'],
            'admin_email' => $_POST['email'],
            'is_active' => $_POST['is_active'],
            'admin_password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hash the password
        ];
        if ($this->adminModel->update($id ,$data)) {
            // Redirect or show a success message
            $this->get();
        } else {
            echo "Failed to add admin.";
        }
    }

    public function filter() {
        $activeFilter = $_GET['active'] ?? null;
        echo "Product ID: " . $activeFilter;
        // die();
        if($activeFilter && $activeFilter!='all'){
            $admins = $this->adminModel->findByFilter($activeFilter);
            require 'views/admin/admins/dash-admins.php';
        }else{
            $admins = $this->adminModel->getAll();
            require 'views/admin/admins/dash-admins.php';
        }
       
    }

    public function login(){
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
            'admin_email' => trim($_POST['adminNameOrEmail']),
            'admin_password' => trim($_POST['adminPassword'])
        ];

        if(empty($data['admin_email']) || empty($data['admin_password'])){
            flash("login", "Please fill out all inputs");
            redirect("/admin/login");
            exit();
        }

        // Check for user/email
        $admin_data_all = $this->adminModel->findByEmail($data['admin_email']);
        $admin_data = $admin_data_all[0];
        if($admin_data['is_active']){
            // User Found
            if(password_verify($data['admin_password'],$admin_data['admin_password'])){
                $this->createAdminSession($admin_data);
            }else{
                flash("login", "Password Incorrect");
                redirect("/admin/login");
            }
        } else {
            flash("login", "No admin found");
            redirect("/admin/login");
        }
    }


    public function createAdminSession($user){
        $_SESSION['admin_id'] = $user['admin_id'];
        $_SESSION['admin_name'] = $user['admin_name'];
        $_SESSION['admin_Email'] = $user['admin_email'];
        $_SESSION['is_super'] = $user['is_super'];
        header("Location: /dash ");
    }

}
