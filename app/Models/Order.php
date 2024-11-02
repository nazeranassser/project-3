<?php
namespace App\Models;
use App\Models\Model;
use PDO; // Use the global PDO class
use PDOException;
require_once 'app/helpers/session_helper.php';
class Order extends Model {

    public $order_id;
    public $customer_id;
    public $coupon_id;
    public $order_total_amount;
    public $order_total_amount_after;
    public $order_status;
    public $delivery_address;
    public $created_at;

    public function __construct() {
        // Pass the table name 'admins' to the BaseModel constructor
        parent::__construct('orders');
    }
    

    function showOrders(){
        $sql =" SELECT orders.order_id,orders.order_status,orders.order_total_amount_after,orders.delivery_address,orders.created_at , customers.customer_phone FROM `orders` CROSS JOIN customers WHERE customers.customer_id = orders.customer_id;";
        $start = $this->db->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC); 
            return $row;
        }
    }

    function totalOrders(){
        $sql =" SELECT COUNT(*) FROM `orders`;";
        $start = $this->db->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC); 
            $total =$row[0]['COUNT(*)'];
            return $total;
        }
    }

    function showOrdersProcessing(){
        $sql =" SELECT COUNT(*) FROM `orders` WHERE order_status = 'processing';";
        $start = $this->db->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC); 
            $_SESSION['processing']=$row[0]['COUNT(*)'];
            return $row;
        }
    }
    function showOrdersDelivered(){
        $sql =" SELECT COUNT(*) FROM `orders` WHERE order_status = 'delivered';";
        $start = $this->db->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC); 
            $_SESSION['delivered']=$row[0]['COUNT(*)'];
            return $row;
        }
    }

    function showOrdersCancelled(){
        $sql =" SELECT COUNT(*) FROM `orders` WHERE order_status = 'cancelled';";
        $start = $this->db->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC); 
            $_SESSION['cancelled']=$row[0]['COUNT(*)'];
            return $row;
        }
    }
  
    function showOrderItems($id){
        // var_dump($id);
        // die();
      $sql ="SELECT products.product_name, products.product_price, products.product_image, order_products.quantity, customers.customer_name, customers.customer_phone, customers.customer_address1, orders.order_total_amount, orders.order_id, orders.order_total_amount_after,orders.created_at,orders.order_status, coupons.coupon_amount FROM products JOIN order_products ON products.product_id = order_products.product_id JOIN orders ON orders.order_id = order_products.order_id JOIN customers ON customers.customer_id = orders.customer_id JOIN coupons ON coupons.coupon_id=orders.coupon_id WHERE order_products.order_id = $id;";
      $start = $this->db->query($sql);
      if ($start) {
          $row = $start->fetchAll(PDO::FETCH_ASSOC); 
          // var_dump($id);
        // die();
          return $row;
      }else {
          echo "0 results";
     }
    }

    function totalSales(){
        $sql = "SELECT SUM(order_total_amount_after) AS total FROM orders WHERE order_total_amount_after <= DATE_SUB(CURDATE(), INTERVAL 30 DAY);";
        $start = $this->db->query($sql);
        if ($start) {
            $total = $start->fetchAll(PDO::FETCH_ASSOC);  
            return  $total;
        }else {
            echo "0 results";
       }
    }

    function updateStatus($id ,$status){
        // var_dump($id);
        // echo '<br>';
        // var_dump($status);
        // die();
        return $this->update($id,$status);
    }
  }