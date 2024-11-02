<?php
namespace App\Models;
use App\Models\Model;
use PDO; // Use the global PDO class
use PDOException;

class Customer extends Model{
    public $uploadDir = 'images/products/';
  public $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

  

    protected $db;
    public $customer_id;
    public $customer_name;
    public $customer_email;
    public $customer_phone;
    public $customer_address1;
    public $customer_address2;
    public $customer_image;
    public $customer_password;
    public $created_at;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection(); // Get the database connection
        parent::__construct('customers');
    }


    function showRow() {
        $sql = "SELECT * FROM customers;";
        $start = $this->db->query($sql);
        if ($start) {
            $row = $start->fetchAll(PDO::FETCH_ASSOC);  
            return $row;
        } else {
            echo "0 results";
        }
    }

    public function findUserByEmailOrUsername($email){
        $stmt =$this->db->prepare('SELECT * FROM customers WHERE customer_email = :email');
        $stmt->bindParam(':email', $email);
        // Execute the statement
        $stmt->execute();
        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($row);
        // die();
        // Check row
        if($row){
            return $row;
        }else{
            return false;
        }
    }

    //Register User
    public function register($data) {
        $stmt = $this->db->prepare("INSERT INTO `customers`( `customer_name`, `customer_email`, `customer_password`, `customer_address1`, `customer_address2`, `customer_phone`) VALUES
            (:name,:email,:password,:firstAddress,:secondAddress,:phoneNumber);");
        //Bind values
        $stmt->bindParam(':name', $data['customer_name']);
        $stmt->bindParam(':email', $data['customer_email']);
        $stmt->bindParam(':password', $data['customer_password']);
        $stmt->bindParam(':firstAddress', $data['customer_address1']);
        $stmt->bindParam(':secondAddress', $data['customer_address2']);
        $stmt->bindParam(':phoneNumber', $data['customer_phone']);

        //Execute
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($nameOrEmail, $password){
        $row = $this->findUserByEmailOrUsername($nameOrEmail);

        if($row == false) return false;
        // var_dump($row);
        $hashedPassword = $row['customer_password'];
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }
    public function getCustomer($id){ 
        try{
            $query = "SELECT * FROM customers WHERE customer_Id=:id";
            $stmt=$this->db->prepare($query);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            if($stmt->rowcount()>0){
                $customer =$stmt->fetch(PDO::FETCH_ASSOC);
                return $customer;
            }else{
                return null;
            }
            }catch(PDOExcption $e){
                error_log($e->getMessage());
                return FALSE;
            }
        }

        public function updateCustomer($id,$data){
            return $this->update($id,$data);
            
        }

        function totalCustomers(){
            $sql =" SELECT COUNT(*) FROM `customers`;";
            $start = $this->db->query($sql);
            if ($start) {
                $row = $start->fetchAll(PDO::FETCH_ASSOC); 
                $total = $row[0]['COUNT(*)'];
                return $total;
            }
        }

        function totalCustomersMonth(){
            $sql = "SELECT SUM(*) AS total FROM customers WHERE created_at <= DATE_SUB(CURDATE(), INTERVAL 30 DAY);";
            $start = $this->db->query($sql);
            if ($start) {
                $total = $start->fetchAll(PDO::FETCH_ASSOC);  
                return  $total;
            }else {
                echo "0 results";
           }
        }
        public function getCustomerOrders($customerId) {
            $sql = "SELECT o.order_id, o.order_total_amount, o.order_total_amount_after, o.order_status, o.created_at,
                           GROUP_CONCAT(p.product_name SEPARATOR '|') as product_names,
                           GROUP_CONCAT(p.product_image SEPARATOR '|') as product_images,
                           GROUP_CONCAT(op.quantity SEPARATOR '|') as quantities
                    FROM orders o
                    JOIN order_products op ON o.order_id = op.order_id
                    JOIN products p ON op.product_id = p.product_id
                    WHERE o.customer_id = :customer_id
                    GROUP BY o.order_id
                    ORDER BY o.created_at DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['customer_id' => $customerId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getOrderDetails($order_id, $customer_id) {
            try {
                $sql = "SELECT o.order_ID, o.created_at as order_date, o.order_status as status,
                               o.order_total_amount_after as total_amount,
                               op.quantity, p.product_name, p.product_image, p.product_price
                        FROM orders o
                        JOIN order_products op ON o.order_ID = op.order_ID
                        JOIN products p ON op.product_ID = p.product_ID
                        WHERE o.order_ID = :order_id AND o.customer_ID = :customer_id";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    'order_id' => $order_id,
                    'customer_id' => $customer_id
                ]);
                
                // إضافة طباعة للتأكد من البيانات
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // للتأكد من البيانات المسترجعة
                if (empty($results)) {
                    error_log("No results found for order_id: $order_id and customer_id: $customer_id");
                    return false;
                }
                
                return $results;
                
            } catch (PDOException $e) {
                error_log("Database Error: " . $e->getMessage());
                return false;
            }
        }

}