<?php
namespace App\Models;
use App\Models\Model;
use PDO; // Use the global PDO class
use PDOException;

class OrderProduct extends Model
{

    public $orderProduct_id;
    public $order_id;
    public $product_id;
    public $quantity;
    public $price;
    public $created_at;


    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function checkPurchase($customer_id, $product_id)
    {
        $sql = "SELECT * FROM order_products AS op
                INNER JOIN orders AS o ON op.order_id = o.order_id
                WHERE o.customer_id = :customer_id AND op.product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0; // Returns true if a record is found, meaning the product was purchased
    }

}
?>