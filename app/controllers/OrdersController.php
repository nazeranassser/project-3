<?php
namespace App\Controllers;
use App\Models\Order;

class OrdersController {
    private $ordersModel;

    public function __construct() {
        $this->ordersModel = new Order();
    }

    // public function index() {
    //     $customers = $this->ordersModel->showRow();
    //     require 'views/admin/customers/dash-customers.php';
    // }

    public function get() {
        if ($orders = $this->ordersModel->get()) {
            require 'views/admin/orders/dash-orders.php'; // Adjust path as needed
        } else {
            echo 'No admins found.';
        }
    }

    public function add() {
        require 'views/admin/admins/dash-admin-add.php'; // Adjust the path accordingly
    }

    public function orderDetails() {
        $orderFilter = $_GET['id'] ?? null;
        // echo "Product ID: " . $orderFilter;
        // die();
        if($orderFilter!='all'){
        // var_dump($id);
        // die();
        if ($orders = $this->ordersModel->showOrderItems($orderFilter)) {
            require 'views/admin/orders/dash-manage-order.php';}
    } else {
            header("location:/404");
    } // Adjust the path accordingly
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the posted data
            $data = [
                'admin_name' => $_POST['name'],
                'admin_email' => $_POST['email'],
                'admin_password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hash the password
            ];

            // Call the model to add the admin
            if ($this->adminModel->addNew($data)) {
                // Redirect or show a success message
                $this->get();
            } else {
                echo "Failed to add admin.";
            }
        } else {
            // If it's not a POST request, redirect or show an error
            echo "Invalid request.";
        }
    }

    function orderStatus(){
        $order_id = $_GET['id'];
        $status = $_GET['status'];
        $orderStatus = [
            'order_status' => $status ];
        $this->ordersModel->updateStatus($order_id,$orderStatus);
            header('location:/orderDetails?id='.$order_id );
        
    }
    
}

