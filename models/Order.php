<?php
require 'config.php';
class Order {

    public $order_id;
    public $customer_id;
    public $coupon_id;
    public $order_total_amount;
    public $order_total_amount_after;
    public $order_status;
    public $delivery_address;
    public $created_at;

    // Show all orders with customer information
    function showOrders(){
        $dbInstance = Database::getInstance();
        $conn = $dbInstance->getConnection();
        $sql = "SELECT customers.customer_phone, orders.* FROM `customers` LEFT JOIN orders ON orders.customer_ID = customers.customer_ID;";
        $start = $conn->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC);  
            return $row;
        } else {
            echo "0 results";
        }
    }
  
    // Show items in a specific order
    function showOrderItems($order){
        $dbInstance = Database::getInstance();
        $conn = $dbInstance->getConnection();
        $id = $order;
        $sql = "SELECT products.product_name, products.product_price, products.product_image, order_products.quantity, customers.customer_name, customers.customer_phone, customers.customer_address1, orders.order_total_amount, orders.order_total_amount_after, orders.created_at, orders.order_status, coupons.coupon_amount 
                FROM products 
                JOIN order_products ON products.product_ID = order_products.product_ID 
                JOIN orders ON orders.order_ID = order_products.order_ID 
                JOIN customers ON customers.customer_ID = orders.customer_ID 
                JOIN coupons ON coupons.coupon_ID = orders.coupon_ID 
                WHERE order_products.order_ID = $id;";
        $start = $conn->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC); 
            return $row;
        } else {
            echo "0 results";
        }
    }

    // Add functionality to create a new order
    function createOrder($customer_id, $order_total_amount, $delivery_address, $coupon_id = null) {
        $dbInstance = Database::getInstance();
        $conn = $dbInstance->getConnection();

        $this->customer_id = $customer_id;
        $this->order_total_amount = $order_total_amount;
        $this->delivery_address = $delivery_address;
        $this->coupon_id = $coupon_id;
        $this->order_status = 'Pending'; // Default status
        $this->created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO orders (customer_id, order_total_amount, delivery_address, coupon_id, order_status, created_at) 
                VALUES (:customer_id, :order_total_amount, :delivery_address, :coupon_id, :order_status, :created_at)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':order_total_amount', $this->order_total_amount);
        $stmt->bindParam(':delivery_address', $this->delivery_address);
        $stmt->bindParam(':coupon_id', $this->coupon_id);
        $stmt->bindParam(':order_status', $this->order_status);
        $stmt->bindParam(':created_at', $this->created_at);

        return $stmt->execute();
    }

    // Functionality to update order status
    function updateOrderStatus($order_id, $status) {
        $dbInstance = Database::getInstance();
        $conn = $dbInstance->getConnection();

        $sql = "UPDATE orders SET order_status = :order_status WHERE order_id = :order_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':order_status', $status);
        $stmt->bindParam(':order_id', $order_id);

        return $stmt->execute();
    }
}
