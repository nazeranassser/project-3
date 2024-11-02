<?php
namespace App\Controllers;
use App\Models\Product;
use App\Models\Coupons;
class CouponsController{
    private $adminModel;

    public function __construct() {
        $this->couponsModel = new Coupons();
        
    }
    public function get() {
        if(isset($_SESSION['admin_id'])){
            if ($coupons = $this->couponsModel->getAll()) {
                require 'views/admin/coupons/dash-coupons.php'; // Adjust path as needed
            } else {
                echo 'No admins found.';
            }
        }else{
            require 'views/pages/404.php';
        }
    }

    public function addPage(){
        if(isset($_SESSION['admin_id'])){
            require 'views/admin/coupons/dash-coupon-add.php';}
            else{
                require 'views/pages/404.php';
            }
    }

    public function editPage($id){
        if(isset($_SESSION['admin_id'])){
            $coupon = $this->couponsModel->findById($id);
            require 'views/admin/coupons/dash-coupon-edit.php';}
            else{
                require 'views/pages/404.php';
            }
    }

    function add(){

        $data = [
            'coupon_value' => $_POST['coupon_name'],
            'coupon_amount' => $_POST['coupon_amount'],
            'coupon_expire' => $_POST['coupon_expire'],
            'created_at' => date("Y/m/d h:m:s"),
        ];
        if ($this->couponsModel->create($data)) {
            // Redirect or show a success message
            header("location:/coupons");
        } else {
            echo "Failed to add admin.";
        }
    }

    function updateCoupon(){
        $id = $_POST['coupon_id'];
        $data = [
            'coupon_value' => $_POST['coupon_name'],
            'coupon_amount' => $_POST['coupon_amount'],
            'coupon_expire' => $_POST['coupon_expire'],
            // 'created_at' => date("Y/m/d h:m:s"),
        ];
        if ($this->couponsModel->update($id,$data)) {
            // Redirect or show a success message
            header("location:/coupons");
        } else {
            echo "Failed to add admin.";
        }
    }

    public function delete(){
        $this->couponsModel->deleteCoupon($_POST['delete_coupon']);
        header("location:/coupons");

    }

    public function applyCoupon() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['coupon_code'])) {
            $couponCode = trim($_POST['coupon_code']);
            $coupon = $this->couponsModel->validateCoupon($couponCode);
            
            if ($coupon) {
                // Coupon is valid
                $discountAmount = $coupon['coupon_amount'];
                $couponId = $coupon['coupon_id'];
                $_SESSION['discount'] = $discountAmount; // Store discount in session
                $_SESSION['coupon_code'] = $couponCode;
                $_SESSION['coupon_id'] = $couponId;
                // Redirect back to the cart or order page
                header("Location: /checkout"); // Adjust path as needed
                exit;
            } else {
                // Invalid coupon logic
                $_SESSION['coupon_error'] = "Invalid coupon code.";
                header("Location: /checkout"); // Adjust path as needed
                exit;
            }
        }
    }

    public function removeCoupon() {
        unset($_SESSION['discount']);
        unset($_SESSION['coupon_code']); // Remove the coupon code
        header("Location: /checkout"); // Adjust path as needed
        exit;
    }

}