<?php

class CreateCouponsTable
{
    public function up()
    {
        return "CREATE TABLE IF NOT EXISTS `coupons` (
            `coupon_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `coupon_amount` varchar(255) NOT NULL,
            `coupon_value` varchar(255) NOT NULL,
            `coupon_expire` date NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
        )"; 
    }

    public function down()      
    {   
        return "DROP TABLE IF EXISTS `coupons`";
    }
}
