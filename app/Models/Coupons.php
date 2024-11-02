<?php 
namespace App\Models;
use App\Models\Model;


class Coupons extends Model{
  // Properties
    public function __construct() {
     parent::__construct('coupons');
     
    }
    
    public function findById($id) {
        return $this->get($id);
    }

    public function getAll(){
        return $this->get();
    }

    public function updateCoupons($id,$data){
        return $this->update($id,$data);
    }

    public function createCoupon($data){
        return $this->create($data);
    }

    public function deleteCoupon($id){
        return $this->delete($id);
    }
    public function validateCoupon($code) {
        $stmt = $this->db->prepare("SELECT coupon_id , coupon_amount FROM coupons WHERE coupon_value = :code");
        $stmt->execute(['code' => $code]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}

